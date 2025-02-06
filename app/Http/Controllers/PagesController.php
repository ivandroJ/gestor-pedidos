<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PagesController extends Controller
{
    public function home()
    {

        return view('pages.home', [
            'opcoes_menu' => Config::get('constants.OPCOES_MENU_' . Auth::user()->perfil, [])
        ]);
    }
}
