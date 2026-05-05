<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:2', 'max:255'],
            'apellidos' => ['required', 'string', 'min:2', 'max:255'],
            'correo' => ['required', 'email', 'max:255', Rule::unique('usuarios', 'correo')],
            'clave' => ['required', 'string', 'min:3', 'max:255'],
            'rol' => ['required', Rule::in([
                Usuario::ROL_ADMINISTRADOR,
                Usuario::ROL_GERENTE,
                Usuario::ROL_CLIENTE,
                Usuario::ROL_VENDEDOR,
            ])],
        ];
    }
}
