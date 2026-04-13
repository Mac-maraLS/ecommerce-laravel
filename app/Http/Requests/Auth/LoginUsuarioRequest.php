<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'correo' => ['required', 'email'],
            'clave' => ['required', 'string', 'min:3', 'max:255'],
        ];
    }

    public function authenticate(): void
    {
        $credentials = [
            'correo' => $this->string('correo')->toString(),
            'password' => $this->string('clave')->toString(),
        ];

        if (! Auth::attempt($credentials)) {
            Log::channel('autenticacion')->warning('Login incorrecto', [
                'correo' => $this->string('correo')->toString(),
                'ip' => $this->ip(),
            ]);

            throw ValidationException::withMessages([
                'correo' => 'Las credenciales proporcionadas no son validas.',
            ]);
        }
    }
}
