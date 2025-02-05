@extends('layouts.app')

@section('content')
    <div class="flex justify-end mb-4">
        <button id="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            <i class="fas fa-plus"></i>
            Novo
        </button>
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
                                Solicitante
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
                                        {{ number_format($grupo->saldoPermitido, 2, ',', '.') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $grupo->solicitante->usuario->nome ?? '-' }}
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
