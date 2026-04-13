<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateCategoriaRequest extends StoreCategoriaRequest
{
    public function rules(): array
    {
        $categoria = $this->route('categoria');

        return [
            'nombre' => ['required', 'string', 'min:3', 'max:255', Rule::unique('categorias', 'nombre')->ignore($categoria?->id)],
            'descripcion' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }
}
