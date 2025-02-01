<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputSelect extends Component
{
    /**
     * Create a new component instance.
     */

    public $id, $title, $name, $itens, $value;

    public function __construct($id, $title, $name, $itens, $value)
    {
        $this->id = $id ?? $name;
        $this->title = $title;
        $this->name = $name;
        $this->itens = $itens;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-select');
    }
}
