<?php

namespace App\Http\Controllers;

use App\Actions\Usuarios\CreateUsuarioAction;
use App\Actions\Usuarios\ResetPasswordUsuarioAction;
use App\Http\Middleware\IsPerfilAprovador;
use App\Http\Requests\usuarios\StoreUsuarioRequest;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('usuarios.index', [
            'usuarios' => User::all(),
            'usuario' => User::find($request->usuario_id),
            'back_url' => '/',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $is_primeira_vez = false;
        //Permite acesso sem autenticação caso seja a primeira vez (a aplicação não tem usuários 'Aprovadores' registados)
        if (User::where('perfil', 'Aprovador')->count()) {
            $this->middleware('auth');
            $this->middleware(IsPerfilAprovador::class);
        }

        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request, CreateUsuarioAction $action)
    {
        $perfil  = $request->perfil;

        if (User::where('perfil', 'Aprovador')->count()) {
            $this->middleware('auth');
            $this->middleware(IsPerfilAprovador::class);
        } else {
            $perfil = Config::get('constants.PERFIS.aprovador');
        }

        //cria o usuário por uma Action
        $usuario = $action->execute($request->nome, $request->email, $perfil);

        return redirect(Auth::check() ? 'usuarios' : '/')
            ->with('sucess_msg', "Usuário '{$usuario->nome}' cadastrado com sucesso!");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', [
            'back_url' => '/usuarios',
            'usuario' => $usuario,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        return redirect('/usuarios');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return redirect('/usuarios');
    }

    public function reset_password(Request $request, ResetPasswordUsuarioAction $action)
    {

        $this->validate(
            $request,
            [
                'usuario_id' => 'required|exists:USUARIO,id|not_in:' . request()->user()->id,
            ],
            [],
            [
                'usuario_id' => 'Usuário',
            ]
        );

        $usuario = User::find($request->usuario_id);

        $view = redirect("/usuarios?usuario_id={$usuario->id}#detalhes");

        return $action->execute($usuario) ?
            $view->with('sucess_msg', 'Sucesso!')
            : $view->with('error_msg', 'Ocorreu um erro!');
    }

    public function set_password()
    {
        return view('usuarios.set_password', [
            'back_url' => '/',
            'hide_btn_back' => true,
        ]);
    }

    public function set_password_store(Request $request)
    {
        $this->validate(
            $request,
            [
                'password' => 'required|string|max:45',
                'password2' => 'required|same:password',
            ],
            [],
            [
                'password' => 'Senha',
                'password2' => 'Senha Novamente',
            ]
        );

        return
            $request->user()->update([
                'password' => bcrypt($request->password),
                'reseted_password' => null,
            ]) ?
            redirect('/')->with('sucess_msg', 'Senha alterada com sucesso!') :
            redirect('/')->with('error_msg', 'Ocorreu um erro ao alterar a senha!');
    }
}
