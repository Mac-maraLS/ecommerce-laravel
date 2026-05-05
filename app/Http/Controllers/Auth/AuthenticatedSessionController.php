<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUsuarioRequest;
use App\Mail\CodigoVerificacionMail;
use App\Models\CodigoVerificacion;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginUsuarioRequest $request): RedirectResponse
    {
        $data = $request->validated();

        /** @var Usuario|null $usuario */
        $usuario = Usuario::query()->where('correo', $data['correo'])->first();

        if ($usuario === null || ! Hash::check($data['clave'], $usuario->clave)) {
            Log::channel('autenticacion')->warning('Login incorrecto', [
                'correo' => $data['correo'],
                'ip' => $request->ip(),
            ]);

            throw ValidationException::withMessages([
                'correo' => 'Las credenciales proporcionadas no son validas.',
            ]);
        }

        Log::channel('autenticacion')->info('Login correcto fase 1', [
            'usuario_id' => $usuario->id,
            'correo' => $usuario->correo,
            'ip' => $request->ip(),
        ]);

        $codigo = (string) random_int(100000, 999999);

        $usuario->codigosVerificacion()->delete();

        $codigoVerificacion = CodigoVerificacion::create([
            'usuario_id' => $usuario->id,
            'codigo' => $codigo,
            'expiracion' => now()->addMinutes(5),
        ]);

        Log::channel('autenticacion')->info('Codigo 2FA generado', [
            'usuario_id' => $usuario->id,
            'ip' => $request->ip(),
        ]);

        Mail::to($usuario->correo)->send(new CodigoVerificacionMail($usuario, $codigoVerificacion));

        $request->session()->put('2fa_usuario_id', $usuario->id);

        return redirect()->route('login.2fa');
    }

    public function verificarCodigo(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('2fa_usuario_id')) {
            return redirect()->route('login');
        }

        return view('auth.verificar-codigo');
    }

    public function validarCodigo(Request $request): RedirectResponse
    {
        $request->validate([
            'codigo' => ['required', 'digits:6'],
        ]);

        $usuarioId = $request->session()->get('2fa_usuario_id');

        if ($usuarioId === null) {
            return redirect()->route('login');
        }

        /** @var Usuario $usuario */
        $usuario = Usuario::query()->findOrFail($usuarioId);

        /** @var CodigoVerificacion|null $codigoVerificacion */
        $codigoVerificacion = $usuario->codigosVerificacion()->latest()->first();

        if ($codigoVerificacion === null || $codigoVerificacion->expirado()) {
            Log::channel('autenticacion')->warning('Codigo 2FA expirado', [
                'usuario_id' => $usuario->id,
                'ip' => $request->ip(),
            ]);

            $request->session()->forget('2fa_usuario_id');
            $usuario->codigosVerificacion()->delete();

            throw ValidationException::withMessages([
                'codigo' => 'El codigo expiro. Inicia sesion nuevamente.',
            ]);
        }

        if ($codigoVerificacion->codigo !== $request->string('codigo')->toString()) {
            Log::channel('autenticacion')->warning('Codigo 2FA invalido', [
                'usuario_id' => $usuario->id,
                'ip' => $request->ip(),
            ]);

            throw ValidationException::withMessages([
                'codigo' => 'El codigo no es correcto.',
            ]);
        }

        Auth::login($usuario);
        $request->session()->forget('2fa_usuario_id');
        $request->session()->regenerate();
        $usuario->codigosVerificacion()->delete();

        Log::channel('autenticacion')->info('Codigo 2FA validado correctamente', [
            'usuario_id' => $usuario->id,
            'ip' => $request->ip(),
        ]);

        if ($usuario->esAdministrador()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('ventas.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $usuario = $request->user();

        if ($usuario !== null) {
            Log::channel('autenticacion')->info('Logout', [
                'usuario_id' => $usuario->id,
                'correo' => $usuario->correo,
                'ip' => $request->ip(),
            ]);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
