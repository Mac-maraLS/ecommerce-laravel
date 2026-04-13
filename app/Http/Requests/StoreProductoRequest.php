<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:255'],
            'descripcion' => ['required', 'string', 'min:10', 'max:1000'],
            'precio' => ['required', 'numeric', 'min:1', 'max:999999.99'],
            'existencia' => ['required', 'integer', 'min:0', 'max:100000'],
            'usuario_id' => ['required', 'integer', 'exists:usuarios,id'],
            'categorias' => ['required', 'array', 'min:1'],
            'categorias.*' => ['integer', 'exists:categorias,id'],
        ];
    }
}
