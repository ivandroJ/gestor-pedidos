@extends('layouts.app')

@section('content')
    <h4 class="text-sm">Grupo - {{ Auth::user()->solicitante->grupo->nome }}</h4>
    @livewire('pedidos.form-create-pedido')
@endsection
