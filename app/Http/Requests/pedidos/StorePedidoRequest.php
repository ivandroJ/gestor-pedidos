<?php

namespace App\Http\Requests\pedidos;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
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
            'solicitante_id' => 'required|exists:SOLICITANTE,id',
            'materiais' => 'required|array',
            'materiais.*.nome' => 'required|string|max:45',
            'materiais.*.preco' => 'required|numeric|min:0',
            'materiais.*.quantidade' => 'required|int|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'solicitante' => 'Solicitante',
            'materiais' => 'Materiais'
        ];
    }
}
