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
            'pedidos' =>
            request()->user()->isAprovador() ?
                //Caso seja um Perfil 'Aprovador'
                Pedido::whereHas('solicitante.grupo', function ($grupo) {
                    $grupo->where('aprovador_id', request()->user()->id);
                })->orderByDesc('updated_at')->get()
                :
                //Caso seja um Perfil 'Solicitante'
                request()->user()->solicitante->pedidos()->orderByDesc('updated_at')
                ->get(),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        return $pedido;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
