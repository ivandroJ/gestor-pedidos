<span
    {{ $attributes->merge([
        'class' => "px-2 py-1 text-{$color}-{$how_strong} bg-{$color}-100 rounded-full
            ring-offset-1 ring-2 ring-{$color}-400",
    ]) }}>
    {!! $icon ? "<i class='{{ $icon }}'></i>" : '' !!} {{ $label }}
</span>
