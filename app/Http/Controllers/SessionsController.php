<?php

namespace App\Http\Controllers;

use App\Actions\Sessions\StartSessionAction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionsController extends Controller
{
    public function login()
    {
        if (Auth::check())
            return redirect()->to('/inicio');

        if (!User::where('perfil', 'Aprovador')->count())
            return redirect('/usuarios/cadastrar');

        return view('sessions.login');
    }


    public function authenticate(Request $request, StartSessionAction $action)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required|string|max:255',
            ],
            [],
            [
                'email' => 'E-mail',
                'password' => 'Senha',
            ]
        );

        return $action->execute(request('email'), request('password')) ? redirect()->intended('/')
            : back()->withErrors([
                "usuario" => "Credenciais inválidas!"
            ]);
    }

    public function forgot_password()
    {
        return view('sessions.forgot_password', [
            'page_title' => 'Recuperar Senha',
        ]);
    }


    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
