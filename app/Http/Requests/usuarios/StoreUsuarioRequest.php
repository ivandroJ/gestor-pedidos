<?php

namespace App\Http\Requests\usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class StoreUsuarioRequest extends FormRequest
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
            'name' => 'required|string|max:45',
            'password' => 'required|string|min:8|max:45',
            'email' => 'required|email|max:45|unique:USUARIO,email',
            'perfil' => 'required|in:' . implode(',', Config::get('constants.PERFIS')),
            'grupo_id' => 'required_if:perfil,' . Config::get('constants.PERFIS.solicitante'),

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'E-mail',
            'password' => 'Senha',
            'perfil' => 'Perfil',
            'password2' => 'Senha Novamente',
            'grupo_id' => 'Grupo',
        ];
    }
}
