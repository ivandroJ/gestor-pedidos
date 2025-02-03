<div>
    <div class="flex flex-wrap -mx-4">
        <div class="mb-4 md:w-{{ $pedido ? '2/4' : 'full' }} sm:w-full px-2">
            @include('livewire.pedidos.inc.lista-pedidos')
        </div>
        @if ($pedido)
            <div class="mb-4 md:w-2/4 sm:w-full px-2">
                @include('livewire.pedidos.inc.detalhes-pedido')
            </div>
        @endif
    </div>
</div>
