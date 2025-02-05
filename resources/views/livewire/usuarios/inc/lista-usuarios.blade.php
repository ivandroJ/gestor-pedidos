<div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
    <div class="p-1">

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nome
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Perfil
                        </th>
                        <th></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($usuarios as $index => $element)
                        <tr class="hover:bg-gray-200">
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
                                    <x-button wire:click='select_usuario()' color="gray" color_tone='400'
                                        px="2" py="1" class="text-sm w-full">
                                        Fechar
                                    </x-button>
                                @else
                                    <x-button wire:click='select_usuario({{ $index }})' color="blue"
                                        color_tone='500' px="2" py="1" class="text-sm w-full">
                                        <i class="fas fa-list"></i>
                                        Detalhes
                                    </x-button>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
