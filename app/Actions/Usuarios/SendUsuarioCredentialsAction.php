<?php

namespace App\Actions\Usuarios;

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

class SendUsuarioCredentialsAction
{

    public function execute(User $usuario)
    {
        //ENVIA PARA FILA, O ENVIO DO E-MAIL
        dispatch(new SendNotificationMailJob(
            $usuario->email,
            $usuario->nome,
            "Credenciais de Acesso",
            "Caro(a) {$usuario->primeiroNome()},\n
            Eis as credenciais para o acesso:\n\n
            E-mail: {$usuario->email}\n
            Senha: {$usuario->reseted_password}"
        ))
            ->onQueue('email');
    }
}
