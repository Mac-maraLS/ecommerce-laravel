<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    /**
     * Autorizar solicitud
     */
    public function authorize(): bool
    {
        return true; // 🔥 IMPORTANTE (antes estaba en false)
    }

    /**
     * Reglas de validación
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'ticket' => 'required|image|max:2048'
        ];
    }
}