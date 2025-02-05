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

class SendNotificationStatusPedidoUpdateAction
{

    public function execute(Pedido $pedido)
    {
        $message = null;
        $usuario = null;

        switch ($pedido->status) {

            case Config::get('constants.TIPOS_STATUS_PEDIDOS.novo'):
                $grupo = $pedido->solicitante->grupo;
                $usuario = $grupo->aprovador;
                $message = "Caro(a) {$usuario->primeiroNome()}, foi submetido o Pedido #{$pedido->id} do Grupo {$grupo->nome}.";

                break;
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.alteracoes'):
                $usuario = $pedido->solicitante->usuario;
                $message = "Caro(a) {$usuario->primeiroNome()}, foi recomendado que faça alterações no seu Pedido #{$pedido->id}.";
                break;
            default:
                $usuario = $pedido->solicitante->usuario;
                $message = "Caro(a) {$usuario->primeiroNome()}, o seu Pedido #{$pedido->id} foi {$pedido->status}.";
                break;
        }

        //ENVIA PARA FILA, O ENVIO DO E-MAIL
        dispatch(new SendNotificationMailJob(
            $usuario->email,
            $usuario->nome,
            "Actualização do Status do Pedido #{$pedido->id}",
            $message
        ))
            ->onQueue('email');
    }
}
