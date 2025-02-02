<?php

namespace App\Livewire\Pedidos;

use App\Models\Pedido;
use Livewire\Component;

class ListaDetalhesPedidos extends Component
{

    public $pedidos;

    public function mount()
    {
        $this->pedidos = request()->user()->isAprovador() ?
            //Caso seja um Perfil 'Aprovador'
            Pedido::whereHas('solicitante.grupo', function ($grupo) {
                $grupo->where('aprovador_id', request()->user()->id);
            })->orderByDesc('updated_at')->get()
            :
            //Caso seja um Perfil 'Solicitante'
            request()->user()->solicitante->pedidos()->orderByDesc('updated_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.pedidos.lista-detalhes-pedidos');
    }
}
