<?php

namespace App\Livewire\Pedidos;

use App\Models\Material;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Container\Attributes\DB;
use Livewire\Component;

class FormCreatePedido extends Component
{
    public $pedido, $material = [], $materiais_nomes, $show_ad_material = false, $total;


    public function mount()
    {
        $this->materiais_nomes = Material::pluck('nome')->unique()->toArray();

        $this->pedido = [
            'solicitante_id' => request()->user()->id,
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
        Debugbar::info($this->pedido);

        $this->validate([
            'material.nome' => 'required|string|max:45',
            'material.quantidade' => 'required|integer|min:1',
            'material.preco' => 'required|numeric|min:0',
        ], [], [
            'material.nome' => 'Nome',
            'material.quantidade' => 'Quantidade',
            'material.preco' => 'Preço Unitário',
        ]);


        $this->material['subTotal'] = $this->material['preco'] * $this->material['quantidade'];

        array_push(
            $this->pedido['materiais'],
            $this->material
        );

        $this->total += $this->material['subTotal'];

        $this->material = [];
        $this->changeFormAdMaterialVisibility();
    }
}
