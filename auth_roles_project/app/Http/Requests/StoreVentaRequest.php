<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Id_Prod_FK' => 'required|exists:producto,Id_pro',
            'Cant_Ven' => 'required|integer|min:1',
            'Fecha_Ven' => 'required|date',
            'Id_Cli' => 'nullable|exists:cliente,Id_Cli',
        ];
    }

    public function messages(): array
    {
        return [
            'Id_Prod_FK.required' => 'Debe seleccionar un producto.',
            'Cant_Ven.required' => 'La cantidad es obligatoria.',
            'Fecha_Ven.required' => 'La fecha es obligatoria.',
        ];
    }
}
