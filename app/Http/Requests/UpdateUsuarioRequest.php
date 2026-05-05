<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends StoreUsuarioRequest
{
    public function rules(): array
    {
        $usuario = $this->route('usuario');

        return [
            'nombre' => ['required', 'string', 'min:2', 'max:255'],
            'apellidos' => ['required', 'string', 'min:2', 'max:255'],
            'correo' => ['required', 'email', 'max:255', Rule::unique('usuarios', 'correo')->ignore($usuario?->id)],
            'clave' => ['nullable', 'string', 'min:3', 'max:255'],
            'rol' => ['required', Rule::in([
                Usuario::ROL_ADMINISTRADOR,
                Usuario::ROL_GERENTE,
                Usuario::ROL_CLIENTE,
                Usuario::ROL_VENDEDOR,
            ])],
        ];
    }
}
