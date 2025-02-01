@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-xl">Detalhes do Usuário</h4>
    </div>
    <div class="bg-white rounded-lg shadow-lg w-full">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                    <span class="text-lg">{{ $usuario->nome }}</span>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-Mail</label>
                    <span class="text-lg">{{ $usuario->email }}</span>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Perfil</label>
                    <x-pill :label="$usuario->perfil" class="text-lg"></x-pill>
                </div>

                @if ($usuario->isSolicitante())
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Grupo</label>
                        <span class="text-lg">{{ $usuario->solicitante->grupo->nome }}</span>
                    </div>
                @endif

            </div>

            <div class="flex justify-between items-center mb-4">
                <div class="mb-4">
                    @if ($usuario->reseted_password)
                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha Temporária</label>
                        <span>{{ $usuario->reseted_password }}</span>
                    @else
                    <form action="/usuarios/{{ $usuario->id }}/reset_password" method="POST">

                    </form>
                    @endif
                </div>
                <div class="mb-4">
                    <form action=""></form>
                </div>
            </div>
        </div>
    </div>
@endsection
