<?php

namespace App\Http\Requests\solicitantes;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolicitantesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:45',
            'email' => 'required|email|max:45',
            'grupo_id' => 'required|exists:GRUPO,id',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'grupo_id' => 'Grupo',
            'email' => 'E-Mail',
        ];
    }
}
