@extends('layouts.app')

@section('content')
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
                    <!-- Cabeçalho da Tabela -->
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Grupo
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>
                        </tr>
                    </thead>

                    <!-- Corpo da Tabela -->
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($solicitantes as $solicitante)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $solicitante->usuario->nome }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">{{ $solicitante->grupo->nome }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">

                                    <button>
                                        Detalhes
                                    </button>

                                    {{--  <span class="px-2 py-1 text-sm text-green-800 bg-green-100 rounded-full">
                                        Ativo
                                    </span> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@include('solicitantes.modals.create')
@endsection
