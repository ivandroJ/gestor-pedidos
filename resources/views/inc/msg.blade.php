<div class="flex flex-wrap -mx-4 mb-1 space-y-1">
    @foreach (Config::get('constants.NOTIFICATION_CARDS_CONFIG') as $index => $config)
        @php
            $msg = session($index, '');
            if (!strlen($msg)) {
                continue;
            }
        @endphp

        <x-notification-card :id="$index" :color="$config['color']" :textColor="$config['text-color']" :icon="$config['icon']">
            {!! $msg !!}
        </x-notification-card>
    @endforeach
</div>
