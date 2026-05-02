<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'      => 'required|string|max:255',
            'categoria'   => 'required|string',
            'precio'      => 'required|numeric',
            'stock'       => 'required|integer',
            'descripcion' => 'required|string|max:500',
            'imagen'      => 'nullable|image|max:2048'
        ];
    }
}