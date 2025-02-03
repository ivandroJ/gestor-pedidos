<?php

namespace App\Livewire\Pedidos;

use App\Actions\Pedidos\UpdateStatusPedidoAction;
use App\Models\Pedido;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class ListaDetalhesPedidos extends Component
{

    public $pedidos, $pedido = null;

    public function mount($pedido = null)
    {
        $this->pedido = $pedido;

        $this->pedidos = session('is_aprovador') ?
            //Caso seja um Perfil 'Aprovador'
            Pedido::whereHas('solicitante.grupo', function ($grupo) {
                $grupo->where('aprovador_id', request()->user()->id);
            })->orderByDesc('updated_at')
            ->with('solicitante', 'solicitante.grupo', 'solicitante.usuario', 'pedidoHasMateriais', 'pedidoHasMateriais.material')
            ->get()
            :
            //Caso seja um Perfil 'Solicitante'
            request()->user()->solicitante()
            ->with('grupo', 'usuario')->first()
            ->pedidos()->orderByDesc('updated_at')
            ->with('pedidoHasMateriais', 'pedidoHasMateriais.material')
            ->get();
    }

    public function render()
    {
        return view('livewire.pedidos.lista-detalhes-pedidos');
    }

    private function factsCheckOnApproval(): bool
    {
        if (!$this->pedido || !session('is_aprovador'))
            return false;

        return $this->pedido->isYourAprovador(request()->user());
    }

    private function update_status(String $new_status)
    {

        if (!$this->factsCheckOnApproval())
            return;

        $this->pedido->refresh();
        $action = new UpdateStatusPedidoAction();
        $result = $action->execute($this->pedido, $new_status);
        $this->pedido->refresh();
    }

    public function em_revisao()
    {
        $this->update_status(Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao'));
    }

    public function select_pedido($index = null)
    {
        $this->pedido = $index !== null ? $this->pedidos[$index] : null;
        $this->em_revisao();
    }


    public function aprovar()
    {
        $this->update_status(Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado'));
    }
    public function rejeitar()
    {
        $this->update_status(Config::get('constants.TIPOS_STATUS_PEDIDOS.rejeitado'));
    }

    public function solicitar_alteracoes()
    {
        $this->update_status(Config::get('constants.TIPOS_STATUS_PEDIDOS.alteracoes'));
    }

    public function realizar_alteracoes()
    {
        return redirect()->to("/pedido/{$this->pedido->id}/alterar");
    }
}
