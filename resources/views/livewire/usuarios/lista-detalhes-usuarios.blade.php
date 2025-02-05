<div>
    <div class="flex flex-wrap -mx-4">
        <div class="mb-4 md:w-{{ $usuario ? '2/3' : 'full' }} sm:w-full px-2">
            @include('livewire.usuarios.inc.lista-usuarios')
        </div>
        @if ($usuario)
            {{-- DETALHES DO USUARIO SELECIONADO --}}
            @include('livewire.usuarios.inc.detalhes-usuario')
        @endif
    </div>
</div>
