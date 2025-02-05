@extends('layouts.app')

@section('content')
    <div class="flex justify-end mb-4">
        <button id="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            <i class="fas fa-plus"></i>
            Novo
        </button>
    </div>
    @livewire('usuarios.lista-detalhes-usuarios')
    @include('usuarios.modals.create')
@endsection
