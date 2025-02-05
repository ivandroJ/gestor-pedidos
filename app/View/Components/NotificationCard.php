<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class NotificationCard extends Component
{
    /**
     * Create a new component instance.
     */


    public function __construct(
        public String $id,
        public String $color,
        public String $textColor,
        public String $icon
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-card');
    }
}
