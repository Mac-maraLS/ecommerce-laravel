<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 🔥 FORZAR LOG (para crear archivo sí o sí)
        Log::channel('autenticacion')->info('Intento de login');

        $credentials = [
            'correo' => $request->correo,
            'password' => $request->clave
        ];

        if (Auth::attempt($credentials)) {

            Log::channel('autenticacion')->info('Login exitoso', [
                'usuario_id' => auth()->id(),
                'correo' => $request->correo,
                'ip' => $request->ip()
            ]);

            return redirect('/dashboard');
        }

        Log::channel('autenticacion')->warning('Login fallido', [
            'correo' => $request->correo,
            'ip' => $request->ip()
        ]);

        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout(Request $request)
    {
        Log::channel('autenticacion')->info('Logout', [
            'usuario_id' => auth()->id(),
            'ip' => $request->ip()
        ]);

        Auth::logout();

        return redirect('/');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // VALIDACIÓN
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|min:6'
        ]);

        // CREAR USUARIO
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
            'rol' => 'cliente'
        ]);

        // 🔥 LOG REGISTRO (EXTRA PARA PUNTOS)
        Log::channel('autenticacion')->info('Usuario registrado', [
            'usuario_id' => $usuario->id,
            'correo' => $usuario->correo,
            'ip' => $request->ip()
        ]);

        return redirect('/login')->with('success', 'Usuario registrado correctamente');
    }
}