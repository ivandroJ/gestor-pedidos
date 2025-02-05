@php
    //PARA DEFINIR A COR DO MONTANTE
    $currency_color = session('is_aprovador')
        ? 'text-' . ($pedido->isPermitido() ? 'green' : 'red') . '-500'
        : 'text-black-500';
    $status_icon = 'fas fa-' . ($pedido->isPermitido() ? 'check' : 'times');
@endphp

<div class="flex justify-between items-center text-white bg-red-500 rounded-t-lg shadow-lg">
    <div class="p-2">
        <h4 class="text-xl">Detalhes</h4>
    </div>
</div>
<div id="detalhes" class="bg-white rounded-b-lg shadow-lg w-full">
    <div class="p-6">

        <div class="flex flex-wrap -mx-4">
            <div class="md:w-full px-2 py-1">
                <label class="block text-sm text-gray-700 mb-1">Nº</label>
                <span class="text-sm">#{{ $pedido->id }}</span>
            </div>
            <div class="md:w-1/2 px-2 py-1">
                <label class="block text-sm text-gray-700 mb-1">Data da Criação</label>
                <span class="text-sm">{{ $pedido->created_at->format('d/m/Y H:i:s') }}
                    ({{ $pedido->created_at->diffForHumans() }})</span>
            </div>

            <div class="md:w-1/2 px-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Data da Última Actualização</label>
                <span class="text-sm">{{ $pedido->created_at->format('d/m/Y H:i:s') }}
                    ({{ $pedido->updated_at->diffForHumans() }})
                </span>
            </div>
            @if (session('is_aprovador'))
                <div class="md:w-full px-2 py-1 pt-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Solicitante</label>
                    <span class="text-lg">{{ $pedido->solicitante->usuario->nome }}</span>
                </div>

                <div class="sm:w-full md:w-1/2 px-2 py-1 pt-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Grupo</label>
                    <span class="text-lg">{{ $pedido->solicitante->grupo->nome }}</span>
                </div>
                <div class="sm:w-full md:w-1/2 px-2 py-1 pt-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Saldo Permitido do Grupo</label>
                    <span class="text-sm"><x-currency-label :currency="$pedido->solicitante->grupo->saldoPermitido"
                            class="{{ $currency_color }}"></x-currency-label>
                    </span>
                </div>
            @endif
            <div class="md:w-full px-5 py-1 pt-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Total do Pedido</label>
                <x-currency-label :currency="$pedido->total" class="text-xl {{ $currency_color }}"></x-currency-label>

                @if (!$pedido->isPermitido() && session('is_aprovador'))
                    <span class="text-yellow-400 text-sm">
                        (+<x-currency-label
                            currency="{{ $pedido->total - $pedido->solicitante->grupo->saldoPermitido }}"
                            class="text-yellow-400"></x-currency-label>)
                        <i class="fas fa-exclamation-circle hover:text-yellow-600"
                            title="O total do Pedido excede o saldo permitido do grupo '{{ $pedido->solicitante->grupo->nome }}'"></i>
                    </span>
                @endif
            </div>

            <div class="md:w-full px-2 py-1 pt-4 text-center">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <x-pill :label="$pedido->status" class="text-md"></x-pill>
            </div>
            @if (!$pedido->isPermitido() && !session('is_solicitante'))
                <div class="md:w-full px-2 py-1 pt-4">
                    <span class="text-red-600">
                        <i class="fas fa-exclamation-circle"></i>
                        O total do Pedido excede o saldo permitido do Grupo
                        {{ $pedido->solicitante->grupo->nome }}!</span>
                </div>
            @endif
        </div>
        <div wire:loading.class="hidden" wire:target='rejeitar, solicitar_alteracoes, aprovar, realizar_alteracoes'>
            @if (session('is_aprovador') && $pedido->isWaitingAproval())
                <div class="flex flex-wrap -mx-4 mt-5">
                    <div class="md:w-1/2 px-2 py-1">
                        <form wire:submit.prevent='rejeitar'>
                            <button type="submit"
                                onclick="return confirm('Tem certeza que pretende REJEITAR este Pedido?')"
                                class="bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 text-sm w-full">
                                <i class="fas fa-times"></i>
                                Rejeitar
                            </button>
                        </form>
                    </div>
                    <div class="md:w-1/2 px-2 py-1">

                        <form wire:submit.prevent="solicitar_alteracoes">
                            <button type="submit"
                                onclick="return confirm('Tem certeza que pretende SOLICITAR ALTERAÇÕES para este Pedido?')"
                                class="bg-yellow-500 text-white px-2 py-1 rounded-lg hover:bg-yellow-600 text-sm w-full">
                                <i class="fas fa-question"></i>
                                Solicitar Alterações
                            </button>
                        </form>

                    </div>
                    @if ($pedido->isPermitido())
                        <div class="md:w-full px-2 py-1">
                            <form wire:submit.prevent='aprovar'>
                                <button type="submit"
                                    onclick="return confirm('Tem certeza que pretende APROVAR este Pedido?')"
                                    class="bg-green-500 text-white px-2 py-1 rounded-lg hover:bg-green-600 text-sm w-full">
                                    <i class="fas fa-check"></i>
                                    Aprovar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @elseif(session('is_solicitante') && $pedido->isStatusSolicitandoAlteracoes())
                <div class="flex flex-wrap -mx-4 mt-5">
                    <div class="md:w-full px-2 py-1">
                        <form wire:submit.prevent="realizar_alteracoes">
                            <button type="submit"
                                onclick="return confirm('Tem certeza que pretende REALIZAR ALTERAÇÕES neste Pedido?')"
                                class="bg-green-500 text-white px-2 py-2 rounded-lg hover:bg-green-600 text-sm w-full">
                                <i class="fas"></i>
                                Realizar Alterações
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-4 text-center text-xl">
            <x-loading-message
                wire:target='rejeitar, solicitar_alteracoes, aprovar, realizar_alteracoes'></x-loading-message>
        </div>

    </div>
</div>

<div id="detalhes_lista" class="bg-white rounded-lg shadow-lg w-full p-1 mt-4">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr class="text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">
                        Material
                    </th>
                    <th class="px-6 py-3">
                        Preço Unit.
                    </th>
                    <th class="px-6 py-3">
                        Qtd.
                    </th>
                    <th class="px-6 py-3">
                        Sub-total
                    </th>

                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($pedido->pedidoHasMateriais as $pedidoMaterial)
                    <tr class="text-sm">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                            {{ $pedidoMaterial->material->nome }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                            <x-currency-label :currency="$pedidoMaterial->material->preco"></x-currency-label>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">
                            {{ $pedidoMaterial->quantidade }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                            <x-currency-label :currency="$pedidoMaterial->subTotal"></x-currency-label>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
