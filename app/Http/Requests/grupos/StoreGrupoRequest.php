<?php

namespace App\Http\Requests\grupos;

use Closure;
use Illuminate\Foundation\Http\FormRequest;

class StoreGrupoRequest extends FormRequest
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
            'saldoPermitido' => 'required||min:0',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'saldoPermitido' => 'Saldo Permitido',
        ];
    }
}
