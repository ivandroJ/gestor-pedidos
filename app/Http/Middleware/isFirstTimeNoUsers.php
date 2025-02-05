<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isFirstTimeNoUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('is_aprovador') && User::where('perfil', 'Aprovador')->count())
            return redirect('/login')
                ->with('error_msg', 'Acesso Negado!');
        else
            return $next($request);
    }
}
