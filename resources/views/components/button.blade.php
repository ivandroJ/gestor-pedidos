<button
    {{ $attributes->merge([
        'id',
        'class' => "bg-{$color}-{$color_tone} text-{$text_color} px-{$px} py-{$py} rounded-lg hover:bg-{$color}-{$color_tone_hover}",
        'onclick',
        'wire:click'
    ]) }}
    type="{{ $type }}">
    {!! $slot !!}
</button>
