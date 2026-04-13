<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // La autorización se valida en el controlador con Policy
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nombre'    => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo'    => ['required', 'email', 'unique:usuarios,correo', 'max:255'],
            'clave'     => ['required', 'string', 'min:8'],
            'rol'       => ['required', 'string', 'in:administrador,gerente,cliente'],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'nombre.required'    => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'correo.required'    => 'El correo es obligatorio.',
            'correo.email'       => 'El correo no tiene un formato válido.',
            'correo.unique'      => 'Este correo ya está registrado.',
            'clave.required'     => 'La contraseña es obligatoria.',
            'clave.min'          => 'La contraseña debe tener al menos 8 caracteres.',
            'rol.required'       => 'El rol es obligatorio.',
            'rol.in'             => 'El rol seleccionado no es válido.',
        ];
    }
}
