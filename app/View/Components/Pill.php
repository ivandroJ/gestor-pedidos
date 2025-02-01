<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;

class Pill extends Component
{
    /**
     * Create a new component instance.
     */

    public $label, $color, $icon;

    public function __construct(String $label, String $icon = null)
    {
        $this->label = $label;

        switch ($label) {
            case Config::get('constants.PERFIS.aprovador'):
                $this->color = 'green';
                break;
                case Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado') :
                $this->color = 'green';
                break;
            case Config::get('constants.PERFIS.solicitante'):
                $this->color = 'blue';
                break;
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.novo'):
                $this->color = 'blue';
                break;
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao'):
                $this->color = 'yellow';
                break;
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.alteracoes'):
                $this->color = 'orange';
                break;
            default:
                $this->color = 'gray';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pill');
    }
}
