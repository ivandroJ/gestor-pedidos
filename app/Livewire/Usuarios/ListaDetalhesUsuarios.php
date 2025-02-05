<?php

namespace App\Livewire\Usuarios;

use App\Models\User;
use Livewire\Component;

class ListaDetalhesUsuarios extends Component
{
    public $usuarios, $usuario;
    public function mount($usuario = null)
    {
        $this->usuarios = User::orderBy('nome')->get();
        $this->usuario = $usuario;
    }
    public function render()
    {
        return view('livewire.usuarios.lista-detalhes-usuarios');
    }

    public function select_usuario($index = null)
    {
        $this->usuario = $this->usuarios[$index] ?? null;
    }
}
