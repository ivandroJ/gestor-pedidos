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
                                    <button wire:click='select_usuario()'
                                        class="bg-gray-400 text-white px-2 py-1 rounded-lg hover:bg-gray-600 text-sm w-full">
                                        Fechar
                                    </button>
                                @else
                                    <button wire:click='select_usuario({{ $index }})'
                                        class="bg-blue-400 text-white px-2 py-1 rounded-lg hover:bg-blue-600 text-sm w-full">
                                        <i class="fas fa-list"></i>
                                        Detalhes
                                    </button>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
