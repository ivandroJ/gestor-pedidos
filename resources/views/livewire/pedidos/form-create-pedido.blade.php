<div>
    <div class="container mx-auto p-4">
        <div class="flex flex-wrap -mx-2">
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
                                            {{ number_format($material['preco'], 2, ',', '.') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ number_format($material['quantidade']) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="text-sm text-gray-900">
                                            {{ number_format($material['subTotal'], 2, ',', '.') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <button wire:click="remove_material({{ $index }})"

                                            class="text-sm bg-red-600 text-white py-1 px-1 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            <i class="fas fa-trash"></i>
                                        </button>

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
                    <h1 class="text-xl text-center font-bold text-yellow-400">{{ number_format($total, 2, ',', '.') }}
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
                                        <label for="preco" class="block text-sm font-medium text-gray-700">
                                            Preço Unitário <span class="text-red-500">*</span>
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm px-3 py-2">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">$</span>
                                            </div>
                                            <input type="text" name="preco" id="preco"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                                placeholder="0.00" oninput="formatarMontante(this)"
                                                wire:model.defer='material.preco' />
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm" id="currency">AKZ</span>
                                            </div>
                                        </div>
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
                                        <button type="submit"
                                            class="text-sm w-full bg-green-600 text-white py-1 px-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            <i class="fas fa-check"></i>
                                            Adicionar</button>
                                    </div>

                                    <div class="mb-1">
                                        <button
                                            class="text-sm w-full bg-gray-600 text-white py-1 px-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                                            wire:click='changeFormAdMaterialVisibility'>

                                            Cancelar</button>
                                    </div>


                                </form>
                            </div>
                        @else
                            <div class="mb-3">
                                <button
                                    class="text-sm w-full bg-blue-600 text-white py-3 px-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                    wire:click='changeFormAdMaterialVisibility'>
                                    <i class="fas fa-plus"></i>
                                    Adicionar Material</button>
                            </div>

                            <div class="mb-1">
                                <form wire:submit="submeter" onsubmit="return confirm('Confirmar?')">
                                    <button type="submit"
                                    class="text-sm w-full bg-green-600 text-white py-3 px-2 rounded-md hover:bg-yellow-500
                                    focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
                                    <i class="fas fa-check"></i>
                                    Submeter Pedido</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
