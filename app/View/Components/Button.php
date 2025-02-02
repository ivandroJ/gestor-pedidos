<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct(
        public String $color = 'blue',
        public String $text_color = 'white',
        public String $type = 'button',
        public String $px = '2',
        public String $py = '3',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
