@extends('layouts.app')

@section('content')
    <div class="flex justify-end mb-4">
        <x-button id="openModal" color="blue" py="2" px="4">
            <i class="fas fa-plus"></i>
            Novo
        </x-button>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
        <div class="p-1">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <!-- Cabeçalho da Tabela -->
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Saldo Permitido
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Solicitantes
                            </th>
                        </tr>
                    </thead>

                    <!-- Corpo da Tabela -->
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($grupos ?? [] as $grupo)
                            <tr class="hover:bg-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $grupo->nome }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">
                                        <x-currency-label :currency="$grupo->saldoPermitido"></x-currency-label>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @forelse ($grupo->solicitantes->sortBy('usuario.nome') as $solicitante)
                                        # {{ $solicitante->usuario->nome }}<br>
                                    @empty
                                        -
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-gray-300 font-bold py-1 text-center" colspan="3">NENHUM GRUPO REGISTADO
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>



    @include('grupos.modals.create')
@endsection
