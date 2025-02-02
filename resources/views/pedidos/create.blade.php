@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Novo Pedido</h2>
    </div>
    <h4 class="text-sm">Grupo - {{ request()->user()->solicitante->grupo->nome }}</h4>

    @livewire('pedidos.form-create-pedido')

    
@endsection
