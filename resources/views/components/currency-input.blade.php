 <div>
     <label class="block text-sm font-medium text-gray-700">{!! $slot !!} </label>
     <div class="mt-1 relative rounded-md shadow-sm px-3 py-2">
         <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
             <span class="text-gray-500 sm:text-sm">$</span>
         </div>
         <input type="text" {{ $attributes->merge(['id', 'name', 'wire:model.defer', 'value']) }}
             class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
             placeholder="0,00" oninput="formatarMontante(this)" />
         <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
             <span class="text-gray-500 sm:text-sm" id="currency">AKZ</span>
         </div>
     </div>

 </div>
