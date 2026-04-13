<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre'      => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:500'],
            'precio'      => ['required', 'numeric', 'min:0'],
            'existencia'  => ['required', 'integer', 'min:0'],
            'imagen'      => ['required', 'image', 'max:2048'],
        ];
    }

    /**
     * Mensajes de error personalizados.
     */
    public function messages(): array
    {
        return [
            'nombre.required'      => 'El nombre del producto es obligatorio.',
            'nombre.max'           => 'El nombre no puede superar 255 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max'      => 'La descripción no puede superar 500 caracteres.',
            'precio.required'      => 'El precio es obligatorio.',
            'precio.numeric'       => 'El precio debe ser un número.',
            'precio.min'           => 'El precio no puede ser negativo.',
            'existencia.required'  => 'La existencia es obligatoria.',
            'existencia.integer'   => 'La existencia debe ser un número entero.',
            'existencia.min'       => 'La existencia no puede ser negativa.',
            'imagen.required'      => 'La imagen es obligatoria.',
            'imagen.image'         => 'El archivo debe ser una imagen.',
            'imagen.max'           => 'La imagen no puede superar 2MB.',
        ];
    }
}
