@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-xl">Detalhes do Usuário</h4>
    </div>
    <div class="bg-white rounded-lg shadow-lg w-full">
        <div class="p-6">
            <div class="flex flex-wrap -mx-4">
                <div class="mb-4 md:w-1/4 px-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                    <span class="text-lg">{{ $usuario->nome }}</span>
                </div>

                <div class="mb-4 md:w-1/4 px-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-Mail</label>
                    <span class="text-lg">{{ $usuario->email }}</span>
                </div>

                <div class="mb-4 md:w-1/4 px-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Perfil</label>
                    <x-pill :label="$usuario->perfil"></x-pill>
                </div>

                @if ($usuario->isSolicitante())
                    <div class="mb-4 md:w-1/4 px-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Grupo</label>
                        <span class="text-lg">{{ $usuario->solicitante->grupo->nome }}</span>
                    </div>
                @endif

            </div>
            @if (request()->user()->id != $usuario->id)
                <div class="flex justify-between items-center mb-4">
                    <div>
                        @if ($usuario->reseted_password)
                            <label class="block text-sm font-medium text-gray-700 mb-1">Senha Temporária</label>
                            <span>{{ $usuario->reseted_password }}</span>
                        @else
                            <form action="/usuario/reset_password" method="POST"
                                onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                <input type="hidden" name='usuario_id' value="{{ $usuario->id }}">
                                <x-button color="green" type="submit" class="text-sm" px='2' py="1">
                                    Reiniciar Senha
                                </x-button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
