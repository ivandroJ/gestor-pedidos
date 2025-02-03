 <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
     <div class="p-1">

         <div class="overflow-x-auto">
             <table class="min-w-full bg-white">
                 <thead class="bg-gray-50">
                     <tr>
                         <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                             Data da Última Actualização
                         </th>

                         @if (!session('is_solicitante'))
                             <th
                                 class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                 Solicitante
                             </th>
                         @endif
                         <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                             Status
                         </th>
                         <th></th>
                     </tr>
                 </thead>

                 <tbody class="divide-y divide-gray-200">
                     @foreach ($pedidos as $index => $element)
                         <tr class="hover:bg-indigo-200 text-xs">
                             <td class="px-6 py-4 whitespace-nowrap text-center">
                                 <div class=" text-gray-900">{{ $element->updated_at->format('Y-m-d H:i:s') }}
                                     <br> ({{ $element->updated_at->diffForHumans() }})
                                 </div>
                             </td>

                             @if (!session('is_solicitante'))
                                 <td class="px-6 py-4 whitespace-nowrap text-center">
                                     <div class=" text-gray-900">{{ $element->solicitante->usuario->nome }} <br>
                                         (Grupo {{ $element->solicitante->grupo->nome }})
                                     </div>
                                 </td>
                             @endif
                             <td class="px-6 py-4 whitespace-nowrap text-center">
                                 <div class=" text-gray-900">
                                     <x-pill :label="$element->status"></x-pill>
                                 </div>
                             </td>

                             <td class="px-6 py-4 whitespace-nowrap text-center">
                                 @if (($pedido['id'] ?? null) == $element->id)
                                     <button wire:click='select_pedido'
                                         class="bg-gray-400 text-white px-2 py-1 rounded-lg hover:bg-gray-600 text-sm w-full">
                                         Fechar
                                     </button>
                                 @elseif(session('is_aprovador') && $element->isStatusNovo())
                                     <button wire:click="select_pedido({{ $index }})"
                                         class="bg-yellow-400 text-white px-2 py-1 rounded-lg hover:bg-yellow-600 text-sm w-full">
                                         <i class="fas fa-eye"></i>
                                         Analisar
                                     </button>
                                 @else
                                     <button wire:click="select_pedido({{ $index }})"
                                         class="bg-blue-400 text-white px-2 py-1 rounded-lg hover:bg-blue-600 text-sm w-full">
                                         <i class="fas fa-bars"></i>
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
