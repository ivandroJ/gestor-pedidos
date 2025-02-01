<?php

namespace App\Http\Controllers;

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


    public function authenticate(Request $request)
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

        if (Auth::attempt(["email" => request('email'), "password" => request('password')])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return back()->withErrors([
                "usuario" => "Credenciais inválidas!"
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
