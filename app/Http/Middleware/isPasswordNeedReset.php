<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class isPasswordNeedReset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::user()->reseted_password != null && strpos(Route::currentRouteName(), 'Nova Senha') === FALSE) {
            return redirect('/usuario/nova_senha')
                ->with('sucess_msg', session('sucess_msg'))
                ->with('error_msg', session('error_msg'))
                ->with('warning_msg', session('warning_msg'))
                ->with('info_msg', session('info_msg'));
        }

        return $next($request);
    }
}
