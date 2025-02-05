 <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full">
     <div class="p-1">

         <div class="overflow-x-auto">
             <table class="min-w-full bg-white">
                 <thead class="bg-gray-50">
                     <tr>
                         <th class="py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                             Data da Última Actualização
                         </th>

                         @if (!session('is_solicitante'))
                             <th
                                 class="py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                 Solicitante
                             </th>
                         @endif
                         <th class="py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                             Status
                         </th>
                         <th></th>
                     </tr>
                 </thead>

                 <tbody class="divide-y divide-gray-200">
                     @forelse ($pedidos as $index => $element)
                         <tr class="hover:bg-indigo-200 text-xs">
                             <td class="py-4 whitespace-nowrap text-center">
                                 <div class=" text-gray-900">{{ $element->updated_at->format('Y-m-d H:i:s') }}
                                     <br> ({{ $element->updated_at->diffForHumans() }})
                                 </div>
                             </td>

                             @if (!session('is_solicitante'))
                                 <td class="py-4 whitespace-nowrap text-center">
                                     <div class=" text-gray-900">{{ $element->solicitante->usuario->nome }} <br>
                                         (Grupo {{ $element->solicitante->grupo->nome }})
                                     </div>
                                 </td>
                             @endif
                             <td class="py-4 whitespace-nowrap text-center">
                                 <div class="text-xs">
                                     <x-pill :label="$element->status"></x-pill>
                                 </div>
                             </td>

                             <td class="px-2 py-4 whitespace-nowrap text-center">
                                 <div wire:loading.class="hidden" wire:target='select_pedido'>
                                     @if (($pedido['id'] ?? null) == $element->id)
                                         <x-button wire:click='select_pedido' color="gray" color_tone='400'
                                             px="2" py="1" class="text-sm w-full">
                                             Fechar
                                         </x-button>
                                     @elseif(session('is_aprovador') && $element->isStatusNovo())
                                         <x-button wire:click="select_pedido({{ $index }})" color="yellow"
                                             color_tone='400' px="2" py="1" class="text-sm w-full">
                                             <i class="fas fa-eye"></i>
                                             Analisar
                                         </x-button>
                                     @else
                                         <x-button wire:click="select_pedido({{ $index }})" color="blue"
                                             color_tone='400' px="2" py="1" class="text-sm w-full">
                                             <i class="fas fa-bars"></i>
                                             Detalhes
                                         </x-button>
                                     @endif
                                 </div>
                                 <x-loading-message wire:target="select_pedido" class="text-md"></x-loading-message>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td class="text-gray-300 font-bold py-1 text-center" colspan="3">NENHUM PEDIDO REGISTADO
                             </td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
         </div>

     </div>
 </div>
