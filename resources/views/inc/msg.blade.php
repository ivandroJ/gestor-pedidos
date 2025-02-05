@php
    $msgs = [
        'error_msg' => [
            'color' => 'red',
            'text-color' => 'white',
            'icon' => 'exclamation-circle',
            'message' => session('error_msg', $error_msg ?? null),
        ],
        'warning_msg' => [
            'color' => 'yellow',
            'text-color' => 'white',
            'icon' => 'exclamation-triangle',
            'message' => session('warning_msg', $warning_msg ?? null),
        ],
        'info_msg' => [
            'color' => 'blue',
            'text-color' => 'white',
            'icon' => 'info-circle',
            'message' => session('info_msg', $info_msg ?? null),
        ],
        'sucess_msg' => [
            'color' => 'green',
            'text-color' => 'white',
            'icon' => 'check-circle',
            'message' => session('sucess_msg', $sucess_msg ?? null),
        ],
    ];
@endphp

<div class="flex flex-wrap -mx-4 mb-1 space-y-1">
    @foreach ($msgs as $index => $msg)
        @if (!strlen($msg['message']))
            @continue
        @endif

        <x-notification-card :id="$index" :color="$msg['color']" :textColor="$msg['text-color']" :icon="$msg['icon']">
            {!! $msg['message'] !!}
        </x-notification-card>
    @endforeach
</div>
