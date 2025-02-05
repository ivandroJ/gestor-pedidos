<?php

use App\Http\Controllers\GruposController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SolicitantesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Middleware\isFirstTimeNoUsers;
use App\Http\Middleware\isPasswordNeedReset;
use App\Http\Middleware\IsPerfilAprovador;
use App\Http\Middleware\IsPerfilSolicitante;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/login', [SessionsController::class, 'login'])
    ->name('login');
Route::post('/auth', [SessionsController::class, 'authenticate']);
Route::post('/logout', [SessionsController::class, 'logout'])
    ->name('logout');


Route::get('/usuario/recuperar_senha', [SessionsController::class, 'forgot_password'])
    ->name('Recuperação de Senha');
Route::post('/usuario/reset_password', [UsuariosController::class, 'reset_password']);

Route::middleware(isFirstTimeNoUsers::class)->group(function () {
    Route::get('/usuarios/cadastrar', [UsuariosController::class, 'create'])
        ->name('Cadastro de Usuário');
    Route::post('/usuarios', [UsuariosController::class, 'store']);
});


Route::middleware(['auth', isPasswordNeedReset::class])->group(function () {

    Route::prefix('usuario')->group(function () {
        Route::get('/nova_senha', [UsuariosController::class, 'set_password'])
            ->name('Nova Senha');
        Route::post('/set_password', [UsuariosController::class, 'set_password_store'])
            ->name('Nova Senha Store');
    });

    //Apenas Perfis Aprovadores
    Route::middleware(IsPerfilAprovador::class)->group(function () {

        Route::get('/usuarios', [UsuariosController::class, 'index'])
            ->name('Usuários');

        Route::prefix('grupos')->group(function () {
            Route::post('/', [GruposController::class, 'store'])
                ->name('Grupos');
            Route::get('/', [GruposController::class, 'index'])
                ->name('Grupos');
        });
    });

    //Apenas Perfis Solicitantes
    Route::middleware(IsPerfilSolicitante::class)->group(function () {
        Route::get('/pedido/novo', [PedidosController::class, 'create'])
            ->name('Novo Pedido');
        Route::get('/pedido/{id}/alterar', [PedidosController::class, 'edit'])
            ->name('Alterar Pedido');
    });


    Route::get('pedidos', [PedidosController::class, 'index'])
        ->name('Pedidos');

    Route::get('/inicio', [PagesController::class, 'home'])
        ->name('Início');
});






Route::get('/', [SessionsController::class, 'login']);
