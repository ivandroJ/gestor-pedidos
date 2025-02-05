<div>

    <div class="container mx-auto p-4">
        <div class="flex flex-wrap -mx-2">
            <div class="w-full">
                @include('inc.msg')
            </div>
            <!-- Coluna 1 -->
            <div class="w-full md:w-2/3 px-2 mb-4">
                <div class="bg-white p-1 rounded-lg shadow-md">

                    <table class="min-w-full bg-white">
                        <!-- Cabeçalho da Tabela -->
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Material
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Preço Unitário
                                </th>

                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantidade
                                </th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sub-total
                                </th>
                                <th></th>
                            </tr>
                        </thead>

                        <!-- Corpo da Tabela -->
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($lista_materiais as $index => $material)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $material['nome'] }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900">
                                            <x-currency-label :currency="$material['preco']"></x-currency-label>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ number_format($material['quantidade']) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="text-sm text-gray-900">
                                            <x-currency-label :currency="$material['subTotal']"></x-currency-label>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <x-button color="red" color_tone="600" px="1" py="1"
                                            wire:click="remove_material({{ $index }})"
                                            class="text-sm rounded-md">
                                            <i class="fas fa-trash"></i>
                                        </x-button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="font-bold px-6 py-4 whitespace-nowrap text-center text-yellow-400">Nenhum
                                        material adicionado!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Coluna 2 -->
            <div class="w-full md:w-1/3 px-2 mb-4">
                <div class="bg-white p-6 rounded-lg shadow-md mb-5">
                    <h2 class="text-xl font-bold mb-4 text-center">Total</h2>
                    <h1 class="text-2xl text-center font-bold text-yellow-400">
                        <x-currency-label :currency="$total ?? 0"></x-currency-label>
                    </h1>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
                    <div class="p-6">
                        @if ($show_ad_material)
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="text-xl font-bold">Adicionar Material</h4>
                                </div>
                                <form wire:submit.prevent="add_material">
                                    <div class="mb-4">
                                        <label for="nome" class="block text-sm font-medium text-gray-700">
                                            Nome <span class="text-red-500">*</span>
                                        </label>
                                        <input id="nome" type="text" wire:model.defer="material.nome"
                                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="Insira o nome do Material" list="materiais_nomes">

                                        <datalist id="materiais_nomes">
                                            @foreach ($materiais_nomes as $nome)
                                                <option>{{ $nome }}</option>
                                            @endforeach
                                        </datalist>

                                        @error('material.nome')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4 mr-5 w-full grid-cols-6">
                                        <label for="quantidade" class="block text-sm font-medium text-gray-700">
                                            Quantidade <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" min="1" max="999" id="quantidade"
                                            wire:model.defer='material.quantidade'
                                            class="text-center mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="Insira a Quantidade">

                                        @error('material.quantidade')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <x-currency-input id="preco" name="preco"
                                            wire:model.defer='material.preco' value="{{ old('saldoPermitido') }}">
                                            Preço Unitário <span class="text-red-500">*</span>
                                        </x-currency-input>
                                        @error('material.preco')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @error('usuario')
                                        <div class="mb-1 text-center">
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        </div>
                                    @enderror


                                    <div class="mb-4">
                                        <x-button-live color="green" color_tone='600' px="2" py="1"
                                            wire:target='add_material' type="submit" class="text-sm w-full rounded-md">
                                            <i class="fas fa-check"></i>
                                            Adicionar</x-button-live>
                                    </div>

                                    <div class="mb-1">
                                        <x-button color="gray" color_tone='600' px="2" py="1"
                                            class="text-sm w-full rounded-md"
                                            wire:click='changeFormAdMaterialVisibility'>
                                            Cancelar</x-button>
                                    </div>

                                </form>
                            </div>
                        @else
                            <div wire:loading.class="hidden" wire:target='submeter'>
                                <div class="mb-3">
                                    <x-button wire:loading.attr="disabled" color="blue" color_tone='600'
                                        px="3" py="3" class="text-sm w-full"
                                        wire:click='changeFormAdMaterialVisibility'>
                                        <i class="fas fa-plus"></i>
                                        Adicionar Material</x-button>
                                </div>

                                <div class="mb-1">
                                    <form wire:submit="submeter">
                                        <x-button type="submit" color="green" color_tone='700' px="3"
                                            py="3" onclick="return confirm('Confirmar?')"
                                            wire:loading.attr="disabled" wire:target='submeter'
                                            class="text-sm w-full">
                                            <i class="fas fa-check"></i>
                                            Submeter Pedido</x-button>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <x-loading-message wire:target="submeter"></x-loading-message>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
