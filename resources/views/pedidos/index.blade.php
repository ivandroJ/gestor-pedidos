@extends('layouts.app')

@section('content')
    @if (session('is_solicitante'))
        <div class="flex justify-end mb-4">
            <a href="{{ url('/pedido/novo') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                <i class="fas fa-plus"></i>
                Novo
            </a>
        </div>
    @endif

    @livewire('pedidos.lista-detalhes-pedidos', [
        'pedido' => $pedido,
    ])
@endsection
