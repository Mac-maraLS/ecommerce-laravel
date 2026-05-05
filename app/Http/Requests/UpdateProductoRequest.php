<?php

namespace App\Http\Requests;

class UpdateProductoRequest extends StoreProductoRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['fotos'] = ['nullable', 'array', 'max:5'];

        return $rules;
    }
}
