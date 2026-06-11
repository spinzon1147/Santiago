<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Nom_Cli' => 'required|string|max:255',
            'Email_Cli' => 'required|email|max:255',
            'Tel_Cli' => 'required|string|max:20',
            'Direc_Cli' => 'required|string|max:500',
            'Estado_Cli' => 'required|string|max:50',
        ];
    }
}
