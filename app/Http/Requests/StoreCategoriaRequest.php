<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:255', Rule::unique('categorias', 'nombre')],
            'descripcion' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }
}
