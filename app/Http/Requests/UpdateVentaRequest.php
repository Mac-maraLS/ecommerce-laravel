<?php

namespace App\Http\Requests;

class UpdateVentaRequest extends StoreVentaRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['ticket'] = ['nullable', 'image', 'max:2048'];

        return $rules;
    }
}
