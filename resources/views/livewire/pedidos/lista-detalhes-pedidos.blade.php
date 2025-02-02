<div>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
        <div class="p-6">
           
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data da Última Actualização
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data da Criação
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total do Pedido
                            </th>
                            @if (!request()->user()->isSolicitante())
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Solicitante
                                </th>
                            @endif
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($pedidos as $pedido)
                            <tr class="hover:bg-indigo-200">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">{{ $pedido->updated_at->format('Y-m-d H:i:s') }}
                                        <br> ({{ $pedido->updated_at->diffForHumans() }})
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">{{ $pedido->created_at->format('Y-m-d H:i:s') }}
                                        <br> ({{ $pedido->created_at->diffForHumans() }})
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="text-sm text-gray-900">{{ number_format($pedido->total, 2, ',', '.') }}
                                    </div>
                                </td>
                                @if (!request()->user()->isSolicitante())
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $pedido->solicitante->usuario->nome }}
                                        </div>
                                    </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">
                                        <x-pill :label="$pedido->status"></x-pill>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">

                                    <button
                                        class="bg-blue-400 text-white px-2 py-1 rounded-lg hover:bg-blue-600 text-sm">
                                        <i class="fas fa-list"></i>
                                        Detalhes
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
