@extends('layouts.app')
@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Novo Usuário</h2>
        @livewire('usuarios.form-create-usuario')
    </div>
@endsection
