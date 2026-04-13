<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUsuarioRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginUsuarioRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        /** @var \App\Models\Usuario $usuario */
        $usuario = $request->user();

        Log::channel('autenticacion')->info('Login correcto', [
            'usuario_id' => $usuario->id,
            'correo' => $usuario->correo,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('dashboard');
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
