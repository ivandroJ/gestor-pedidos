<?php

namespace App\Livewire\Pedidos;

use App\Actions\Pedidos\StorePedidoAction;
use App\Actions\Pedidos\TransformCurrencyFormatToNumericAction;
use App\Models\Material;
use App\Rules\CurrencyRule;
use Livewire\Component;
use Illuminate\Support\Str;


class FormCreatePedido extends Component
{
    public $pedido, $material = [], $materiais_nomes, $show_ad_material = false, $total;


    public function mount()
    {
        $this->materiais_nomes = Material::pluck('nome')->unique()->toArray();

        $this->pedido = [
            'materiais' => []
        ];
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
                'min:0.01',
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
            $this->pedido['materiais'],
            $this->material
        );

        $this->total += $this->material['subTotal'];

        $this->material = [];
        $this->changeFormAdMaterialVisibility();
    }

    public function remove_material($index)
    {
        if (!isset($this->pedido['materiais'][$index]))
            return;

        $this->total -= $this->pedido['materiais'][$index]['subTotal'];
        unset($this->pedido['materiais'][$index]);
    }

    public function submeter()
    {
        $action = new StorePedidoAction();
        $pedido = $action->execute($this->pedido['materiais']);

        if ($pedido)
            return redirect()->to('/pedidos')->with('sucess_msg', 'Sucesso!');
        
    }
}
