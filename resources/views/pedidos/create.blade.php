@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Novo Pedido</h2>
    </div>
    @livewire('pedidos.form-create-pedido')
@endsection
