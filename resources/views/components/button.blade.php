<button {{ $attributes->merge(['class' => "bg-{$color}-500 text-{$text_color} px-{$px} py-{$py} rounded-lg hover:bg-{$color}-600"]) }}
type="{{ $type }}">
{{ $slot }}
</button>
