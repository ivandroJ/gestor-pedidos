<div {{ $attributes->merge([
    'class' => 'text-yellow-400',
    'wire:target',
]) }} wire:loading>

    <div class="flex items-center justify-center space-x-2">
        <i class="fas fa-spinner animate-spin"></i>
        <p>Aguarde...</p>
    </div>
</div>
