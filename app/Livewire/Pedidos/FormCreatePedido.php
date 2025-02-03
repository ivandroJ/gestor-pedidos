<?php

namespace App\Livewire\Pedidos;

use App\Actions\Pedidos\StorePedidoAction;
use App\Actions\Pedidos\TransformCurrencyFormatToNumericAction;
use App\Actions\Pedidos\UpdatePedidoAction;
use App\Models\Material;
use App\Models\Pedido;
use App\Rules\CurrencyRule;
use Livewire\Component;
use Illuminate\Support\Str;


class FormCreatePedido extends Component
{
    public $pedido, $material = [], $materiais_nomes,
        $show_ad_material = false, $total,
        $lista_materiais = [], $for_edit = false;


    public function mount(?Pedido $pedido = null)
    {

        if ($pedido) {
            $this->for_edit = true;

            $this->lista_materiais = $pedido->pedidoHasMateriais->map(function ($pedidoHasMaterial) {
                return [
                    'material_id' => $pedidoHasMaterial->material->id,
                    'nome' => $pedidoHasMaterial->material->nome,
                    'subTotal' => $pedidoHasMaterial->subTotal,
                    'preco' => $pedidoHasMaterial->material->preco,
                    'quantidade' => $pedidoHasMaterial->quantidade,
                ];
            })->toArray();


            $this->pedido = $pedido;
            $this->total = $pedido->total;
        }

        //PARA SUGESTÕES NO CAMPO DE INSERÇÃO DO NOME DO MATERIAL
        $this->materiais_nomes = Material::pluck('nome')->unique()->toArray();
    }

    public function render()
    {
        return view('livewire.pedidos.form-create-pedido');
    }

    public function changeFormAdMaterialVisibility()
    {
        $this->show_ad_material = !$this->show_ad_material;
    }

    public function add_material()
    {
        $this->validate([
            'material.nome' => 'required|string|max:45',
            'material.quantidade' => 'required|integer|min:1',
            'material.preco' => [
                'required',
                'min:0',
                new CurrencyRule
            ],
        ], [], [
            'material.nome' => 'Nome',
            'material.quantidade' => 'Quantidade',
            'material.preco' => 'Preço Unitário',
        ]);

        $action = new TransformCurrencyFormatToNumericAction();

        $this->material['preco'] = $action->execute($this->material['preco']);
        $this->material['subTotal'] = $this->material['preco'] * $this->material['quantidade'];

        array_push(
            $this->lista_materiais,
            $this->material
        );

        $this->total += $this->material['subTotal'];

        $this->material = [];
        $this->changeFormAdMaterialVisibility();
    }

    public function remove_material($index)
    {
        if (!isset($this->lista_materiais[$index]))
            return;

        $this->total -= $this->lista_materiais[$index]['subTotal'];
        unset($this->lista_materiais[$index]);
    }

    public function submeter()
    {
        $pedido = null;

        if ($this->pedido && $this->for_edit) {
            $action = new UpdatePedidoAction();
            $pedido = $action->execute($this->pedido, $this->lista_materiais);
        } else {
            $action = new StorePedidoAction();
            $pedido = $action->execute($this->lista_materiais);
        }


        if ($pedido)
            return redirect()->to('/pedidos?id=' . $pedido->id)->with('sucess_msg', 'Sucesso!');
    }
}
