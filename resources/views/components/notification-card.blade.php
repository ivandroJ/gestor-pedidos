<div id="{{ $id }}" class="md:w-full px-2 py-1">
    <div class="text-md w-full bg-{{ $color }}-600 py-3 text-{{ $textColor }} px-2 rounded-md">
        <div class="flex flex-wrap">
            <div class="md:w-3/4">
                <i class="fas fa-{{ $icon }}"></i>
                <span>{!! $slot !!}</span>
            </div>
            <div class="md:w-1/4 text-right">
                <button onclick="hide_element('{{ $id }}')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</div>
