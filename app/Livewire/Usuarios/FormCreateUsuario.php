<?php

namespace App\Livewire\Usuarios;

use App\Actions\Usuarios\CreateUsuarioAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class FormCreateUsuario extends Component
{

    public $usuario, $perfis, $grupos, $is_primeira_vez = false;

    public function mount()
    {
        $this->perfis = Config::get('constants.PERFIS');

        if (Auth::check()) {
            $this->grupos = request()->user()->grupos;
            $this->usuario['perfil'] = null;
        } else {
            $this->is_primeira_vez = true;
            $this->usuario['perfil'] = Config::get('constants.PERFIS.aprovador');
        }
    }

    public function render()
    {
        return view('livewire.usuarios.form-create-usuario');
    }


    public function save()
    {
        $this->validate([
            'usuario.nome' => 'required|string|max:45',
            'usuario.email' => 'required|email|max:45|unique:USUARIO,email',
            'usuario.perfil' => 'required|in:' . implode(',', $this->perfis),
            'usuario.grupo_id' => 'required_if:usuario.perfil,' . Config::get('constants.PERFIS.solicitante'),
        ], [], [
            'usuario.nome' => 'Nome',
            'usuario.email' => 'Email',
            'usuario.perfil' => 'Perfil',
            'usuario.grupo_id' => 'Grupo',
        ]);

        $action = new CreateUsuarioAction();

        $usuario = $action->execute(
            $this->usuario['nome'],
            $this->usuario['email'],
            $this->usuario['perfil'],
            $this->usuario['grupo_id'],
        );

        return redirect()->to('/usuarios');
    }
}
