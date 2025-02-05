<?php

namespace App\Actions\Sessions;

use App\Jobs\Pedidos\SendNotificationMailJob;
use App\Mail\Pedidos\NotificationStatusMail;
use App\Models\Material;
use App\Models\Pedido;
use App\Models\PedidoHasMaterial;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StartSessionAction
{

    public function execute(String $email, String $password): bool
    {
        if (Auth::attempt(["email" => $email, "password" => $password])) {
            request()->session()->regenerate();

            if (Auth::user()->isAprovador()) {
                session([
                    'is_aprovador' => true,
                ]);
            } else {
                session([
                    'is_solicitante' => true,
                ]);
            }
            return true;
        } else
            return false;
    }
}
