<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CurrencyLabel extends Component
{
    /**
     * Create a new component instance.
     */
    public $currency;

    public function __construct(float $currency)
    {
        $this->currency = number_format($currency, 2, ',', '.') . ' AKZ';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.currency-label');
    }
}
