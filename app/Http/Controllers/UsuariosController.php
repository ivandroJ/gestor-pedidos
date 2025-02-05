<?php

namespace App\Http\Controllers;

use App\Actions\Sessions\StartSessionAction;
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
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{

    public function index(Request $request)
    {
        return view('usuarios.index', [
            'back_url' => '/',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request, CreateUsuarioAction $createUsuarioAction, StartSessionAction $startSessionAction)
    {
        $perfil  = $request->perfil;

        if (!User::where('perfil', 'Aprovador')->count()) {
            $perfil = Config::get('constants.PERFIS.aprovador');
        }

        //cria o usuário por uma Action
        $usuario = $createUsuarioAction->execute($request->nome, $request->email, $perfil);

        $first_time = false;

        if (!Auth::check()) {
            $startSessionAction->execute($usuario->email, $usuario->reseted_password);
            $first_time = true;
        }

        return redirect(Auth::check() && !$first_time ? 'usuarios' : '/inicio')
            ->with('sucess_msg', "Usuário '{$usuario->nome}' cadastrado com sucesso!");
    }


    public function show(User $usuario)
    {
        return view('usuarios.show', [
            'back_url' => '/usuarios',
            'usuario' => $usuario,
        ]);
    }

    public function reset_password(Request $request, ResetPasswordUsuarioAction $action)
    {

        $this->validate(
            $request,
            [
                'usuario_id' => [
                    Rule::requiredIf(function () {
                        return is_null(request('email'));
                    }),
                    'exists:USUARIO,id',
                    'not_in:' . (isset(Auth::user()->id) ? Auth::user()->id  : '')
                ],
                'email' => [
                    Rule::requiredIf(function () {
                        return is_null(request('usuario_id'));
                    }),
                    'exists:USUARIO,email'
                ],
            ],
            [],
            [
                'usuario_id' => 'Usuário',
                'email' => 'E-Mail',
            ]
        );

        $usuario = $request->filled('email') ?
            User::where('email', $request->email)->first() :
            User::find($request->usuario_id);

        $view = redirect(Auth::check() ?
            "/usuarios?usuario_id={$usuario->id}#detalhes" : '/login');

        if ($usuario->updatedAlredyWithinDay() && !Auth::check() && $usuario->reseted_password)
            return $view->with('warning_msg', 'Já foi solicitada uma recuperação de senha para este usuário!');


        return $action->execute($usuario) ?
            $view->with('sucess_msg', 'Sucesso! Foi enviada as novas credenciais para o seu e-mail.')
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
            redirect('/inicio')->with('sucess_msg', 'Senha alterada com sucesso!') :
            redirect('/inicio')->with('error_msg', 'Ocorreu um erro ao alterar a senha!');
    }
}
