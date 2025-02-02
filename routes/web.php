<?php

use App\Http\Controllers\GruposController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SolicitantesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Middleware\isPasswordNeedReset;
use App\Http\Middleware\IsPerfilAprovador;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/login', [SessionsController::class, 'login'])
    ->name('login');
Route::post('/auth', [SessionsController::class, 'authenticate']);
Route::post('/logout', [SessionsController::class, 'logout'])
    ->name('logout');

//Autenticação é feita no Controller
Route::get('/usuarios/cadastrar', [UsuariosController::class, 'create'])
    ->name('Cadastro de Usuário');
//Autenticação é feita no Controller
Route::post('/usuarios', [UsuariosController::class, 'store']);


Route::middleware(['auth', isPasswordNeedReset::class])->group(function () {

    Route::prefix('usuario')->group(function () {
        Route::get('/nova_senha', [UsuariosController::class, 'set_password'])
            ->name('set_password');
        Route::post('/set_password', [UsuariosController::class, 'set_password_store'])
            ->name('set_password_store');
    });

    //Apenas Perfis Aprovadores
    Route::middleware(IsPerfilAprovador::class)->group(function () {
        Route::post('/usuario/reset_password', [UsuariosController::class, 'reset_password']);
        Route::resource('usuarios', UsuariosController::class);
        Route::resource('grupos', GruposController::class);

        Route::resource('/solicitantes', SolicitantesController::class);
    });

    Route::get('/pedido/novo', [PedidosController::class, 'create']);
    Route::resource('pedidos', PedidosController::class);

    Route::get('/inicio', [PagesController::class, 'home'])
        ->name('home');
});






Route::get('/', [SessionsController::class, 'login']);
