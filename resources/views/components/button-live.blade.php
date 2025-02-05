 <div wire:loading.class="hidden" {{ $attributes->merge(['wire:target']) }}>
     <x-button :color="$color" :color_tone="$color_tone" :px="$px" :py="$py" :type="$type"
         {{ $attributes->merge(['id', 'class', 'onclick', 'wire:click']) }}>
         {!! $slot !!}
     </x-button>
 </div>

 <div class="text-center">
     <x-loading-message {{ $attributes->merge(['wire:target']) }}></x-loading-message>
 </div>
