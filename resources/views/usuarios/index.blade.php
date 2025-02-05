@extends('layouts.app')

@section('content')
    <div class="flex justify-end mb-4">
        <x-button id="openModal" color="blue" color_tone='500' px="4" py="2">
            <i class="fas fa-plus"></i>
            Novo
            </x-button>
    </div>
    @livewire('usuarios.lista-detalhes-usuarios')
    @include('usuarios.modals.create')
@endsection
