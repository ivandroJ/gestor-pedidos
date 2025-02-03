<?php

namespace App\Actions\Pedidos;

use App\Jobs\Pedidos\SendNotificationMailJob;
use App\Mail\Pedidos\NotificationStatusMail;
use App\Models\Material;
use App\Models\Pedido;
use App\Models\PedidoHasMaterial;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendNotificationPendentPedidosAction
{

    public function execute()
    {
        //APROVADORES
        foreach (
            User::where('perfil', Config::get('constants.PERFIS.aprovador'))
                ->whereHas('grupos.solicitante.pedidos', function ($pedido) {
                    $pedido->where(function ($pedido) {
                        $pedido->where('status', Config::get('constants.TIPOS_STATUS_PEDIDOS.novo'))
                            ->orWhere('status', Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao'));
                    })->where('updated_at', '<', now()->subDay());
                })->get() as $usuario
        ) {

            $message = "
        Caro(a) {$usuario->primeiroNome()}, tem pedido(s) pendente(s) a mais de 24h, por favor entre no para dar o devido tratamento.
        ";

            dispatch(new SendNotificationMailJob(
                $usuario->email,
                $usuario->nome,
                "!!Aviso de Pedidos Pendentes!! " . date('Y-m-d'),
                $message
            ))
                ->onQueue('email');
        }

        //SOLICITANTES
        foreach (
            User::where('perfil', Config::get('constants.PERFIS.solicitante'))
                ->whereHas('solicitante.pedidos', function ($pedido) {
                    $pedido->where('status', Config::get('constants.TIPOS_STATUS_PEDIDOS.alteracoes'))
                        ->where('updated_at', '<', now()->subDay());
                })->get() as $usuario
        ) {

            $message = "
        Caro(a) {$usuario->primeiroNome()}, tem pedido(s) pendente(s) para alteração a mais de 24h, por favor entre no Sistema para dar o devido tratamento.
        ";

            dispatch(new SendNotificationMailJob(
                $usuario->email,
                $usuario->nome,
                "!!Aviso de Pedidos Pendentes!! " . date('Y-m-d'),
                $message
            ))
                ->onQueue('email');
        }
    }
}
