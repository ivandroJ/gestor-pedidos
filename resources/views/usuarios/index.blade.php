@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap -mx-4">
        <div class="mb-4 md:w-{{ $usuario ? '2/3' : 'full' }} sm:w-full px-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
                <div class="p-6">
                    <div class="flex justify-end mb-4">
                        <button id="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            <i class="fas fa-plus"></i>
                            Novo
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Perfil
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($usuarios as $element)
                                    <tr class="hover:bg-indigo-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $element->nome }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="text-sm text-gray-900">

                                                <x-pill :label="$element->perfil"></x-pill>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if (($usuario['id'] ?? null) == $element->id)
                                                <a href="{{ url('/usuarios') }}"
                                                    class="bg-gray-400 text-white px-2 py-1 rounded-lg hover:bg-gray-600 text-sm w-full">
                                                    Fechar
                                                </a>
                                            @else
                                                <a href="{{ url('/usuarios?usuario_id=' . $element->id . '#detalhes') }}"
                                                    class="bg-blue-400 text-white px-2 py-1 rounded-lg hover:bg-blue-600 text-sm w-full">
                                                    <i class="fas fa-list"></i>
                                                    Detalhes
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        @if ($usuario)
            {{-- DETALHES DO USUARIO SELECIONADO --}}
            <div class="mb-4 md:w-1/3 sm:w-full px-2">
                <div class="flex justify-between items-center text-white bg-red-500 rounded-t-lg shadow-lg">
                    <div class="p-2">
                        <h4 class="text-xl">Detalhes</h4>
                    </div>
                </div>
                <div id="detalhes" class="bg-white rounded-b-lg shadow-lg w-full">
                    <div class="p-6">

                        <div class="grid flex-wrap -mx-4">
                            <div class="mb-5 md:w-full px-2 py-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                <span class="text-lg">{{ $usuario->nome }}</span>
                            </div>

                            <div class="mb-5 md:w-full px-2 py-1 border-t-2 pt-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">E-Mail</label>
                                <span class="text-lg">{{ $usuario->email }}</span>

                            </div>

                            <div class="mb-5 md:w-full px-2 py-1 border-t-2 pt-3">

                                <label class="block text-sm font-medium text-gray-700 mb-1">Perfil</label>
                                <x-pill :label="$usuario->perfil" class="text-lg"></x-pill>
                            </div>

                            @if ($usuario->isSolicitante())
                                <div class="mb-5 md:w-full px-2 py-1 border-t-2 pt-3">

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Grupo</label>
                                    <span class="text-lg">{{ $usuario->solicitante->grupo->nome }}</span>

                                </div>
                            @endif
                        </div>
                        @if (request()->user()->id != $usuario->id)
                            <div class="flex flex-wrap -mx-4">
                                <div class="md:w-full px-2 py-1 border-t-2 pt-3">
                                    @if ($usuario->reseted_password)
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha Temporária</label>
                                        <span>{{ $usuario->reseted_password }}</span>
                                    @else
                                        <form action="/usuario/reset_password" method="POST"
                                            onsubmit="return confirm('Tem certeza?')">
                                            @csrf
                                            <input type="hidden" name='usuario_id' value="{{ $usuario->id }}">
                                            <x-button color="green" type="submit" class="text-sm w-full sm:w-full" px='2'
                                                py="2">
                                                Reiniciar Senha
                                            </x-button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
    @include('usuarios.modals.create')

@endsection
