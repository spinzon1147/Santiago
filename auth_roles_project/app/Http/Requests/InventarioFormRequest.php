<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Precio_Com' => 'required|numeric|min:0',
            'Precio_Ven' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'Categoria' => 'nullable|string|max:255',
            'Descripcion' => 'nullable|string|max:500',
            'Id_Proveedor' => 'nullable|exists:proveedors,Id_Prov',
            'Id_Producto' => 'required|exists:producto,Id_pro',
        ];
    }

    public function messages(): array
    {
        return [
            'Precio_Com.required' => 'El precio de compra es obligatorio.',
            'Precio_Ven.required' => 'El precio de venta es obligatorio.',
            'Stock.required' => 'El stock es obligatorio.',
            'Id_Producto.required' => 'Debe seleccionar un producto.',
        ];
    }
}
