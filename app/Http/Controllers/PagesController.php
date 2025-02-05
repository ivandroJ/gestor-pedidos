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
        Debugbar::info(session('error_msg'));

        return view('pages.home', [
            'opcoes_menu' => Config::get('constants.OPCOES_MENU_' . Auth::user()->perfil, [])
        ]);
    }
}
