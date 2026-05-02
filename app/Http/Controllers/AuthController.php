<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\CodigoVerificacion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;
use App\Mail\Codigo2FAMail;

class AuthController extends Controller
{
    // 🔐 LOGIN VIEW
    public function showLogin()
    {
        return view('auth.login');
    }

    // 📝 REGISTER VIEW
    public function showRegister()
    {
        return view('auth.register');
    }

    // 📝 REGISTRAR USUARIO
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|min:6'
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
            'rol' => 'cliente'
        ]);

        return redirect('/login')->with('success', 'Usuario registrado correctamente');
    }

    // 🔐 LOGIN (2FA)
    public function login(Request $request)
    {
        $credentials = [
            'correo' => $request->correo,
            'password' => $request->clave
        ];

        if (Auth::validate($credentials)) {

            $usuario = Usuario::where('correo', $request->correo)->first();

            $codigo = rand(100000, 999999);

            CodigoVerificacion::create([
                'usuario_id' => $usuario->id,
                'codigo' => $codigo,
                'expiracion' => now()->addMinutes(5)
            ]);

            Mail::to($usuario->correo)->send(new Codigo2FAMail($codigo));

            Log::channel('autenticacion')->info('Codigo 2FA generado', [
                'usuario_id' => $usuario->id,
                'codigo' => $codigo
            ]);

            session(['2fa_user' => $usuario->id]);

            return redirect('/verificar-codigo');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    // 📩 FORM 2FA
    public function formCodigo()
    {
        return view('auth.codigo');
    }

    // ✅ VALIDAR CÓDIGO
    public function validarCodigo(Request $request)
    {
        $usuario_id = session('2fa_user');

        $registro = CodigoVerificacion::where('usuario_id', $usuario_id)
            ->latest()
            ->first();

        if (!$registro) {
            return redirect('/login');
        }

        if ($registro->codigo != $request->codigo) {
            return back()->with('error', 'Código incorrecto');
        }

        if (now()->gt($registro->expiracion)) {
            return back()->with('error', 'Código expirado');
        }

        Auth::loginUsingId($usuario_id);

        return redirect('/dashboard');
    }

    // 🔓 LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}