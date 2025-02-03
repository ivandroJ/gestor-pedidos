<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsPerfilSolicitante;
use App\Http\Requests\pedidos\StorePedidoRequest;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pedidos.index', [
            'back_url' => '/',
            'pedido' => Pedido::find(request('id')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->middleware(IsPerfilSolicitante::class);

        return view('pedidos.create', [
            'back_url' => '/pedidos'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        return redirect('/pedidos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        return redirect('/pedidos');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->middleware(IsPerfilSolicitante::class);

        $pedido = Pedido::find($id);

        if (!$pedido->isStatusSolicitandoAlteracoes())
            return back()->with('warning_msg', 'Não foram solicitadas alterações para este pedido!');

        return view('pedidos.edit', [
            'back_url' => '/pedidos?id=' . $pedido->id,
            'pedido' => $pedido
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        return redirect('/pedidos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        return redirect('/pedidos');
    }
}
