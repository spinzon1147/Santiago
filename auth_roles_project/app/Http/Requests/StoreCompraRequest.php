<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Id_Prod_FK' => 'required|exists:producto,Id_pro',
            'Cant_Com' => 'required|integer|min:1',
            'Fecha_Com' => 'required|date',
            'Precio_Com' => 'required|numeric|min:0',
            'Id_Proveedor' => 'nullable|exists:proveedors,Id_Prov',
        ];
    }

    public function messages(): array
    {
        return [
            'Id_Prod_FK.required' => 'Debe seleccionar un producto.',
            'Cant_Com.required' => 'La cantidad es obligatoria.',
            'Fecha_Com.required' => 'La fecha es obligatoria.',
            'Precio_Com.required' => 'El precio de compra es obligatorio.',
        ];
    }
}
