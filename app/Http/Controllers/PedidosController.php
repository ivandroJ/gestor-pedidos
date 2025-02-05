<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsPerfilSolicitante;
use App\Http\Requests\pedidos\StorePedidoRequest;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PedidosController extends Controller
{
    
    public function index()
    {
        return view('pedidos.index', [
            'page_title' => "Pedidos",
            'back_url' => '/',
            'pedido' => Pedido::find(request('id')),
        ]);
    }

    public function create()
    {
        return view('pedidos.create', [
            'page_title' => "Novo Pedido",
            'back_url' => '/pedidos'
        ]);
    }

    public function edit($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido->isStatusSolicitandoAlteracoes())
            return back()->with('warning_msg', 'Não foram solicitadas alterações para este pedido!');

        return view('pedidos.edit', [
            'back_url' => '/pedidos?id=' . $pedido->id,
            'page_title' => "Alterar Pedido #{$pedido->id}",
            'pedido' => $pedido
        ]);
    }

}
