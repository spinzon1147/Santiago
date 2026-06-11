<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nom_Prov' => 'required|string|max:255',
            'Tel_Prov' => 'required|string|max:20',
            'Direc_Prov' => 'required|string|max:500',
            'Estado_Prov' => 'required|string|max:50',
        ];
    }
}
