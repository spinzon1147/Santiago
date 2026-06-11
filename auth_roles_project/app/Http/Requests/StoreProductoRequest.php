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
            'Nom_pro' => 'required|string|max:255',
            'Cant_pro' => 'required|integer|min:0',
            'Precio_pro' => 'required|numeric|min:0',
            'Estado_pro' => 'required|string|max:50',
            'Descrip_pro' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'Nom_pro.required' => 'El nombre del producto es obligatorio.',
            'Cant_pro.required' => 'La cantidad es obligatoria.',
            'Precio_pro.required' => 'El precio es obligatorio.',
            'Estado_pro.required' => 'El estado es obligatorio.',
        ];
    }
}
