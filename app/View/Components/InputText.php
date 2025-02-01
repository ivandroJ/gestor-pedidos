<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{
    /**
     * Create a new component instance.
     */

    public $id, $title, $name, $type, $placeholder, $value, $is_live;

    public function __construct($title, $name, $placeholder, $type, $id, $value, $is_live = '')
    {
        $this->id = $id ?? $name;
        $this->title = $title;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;
        $this->is_live = $is_live;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-text');
    }
}
