<?php

namespace App\Actions\Pedidos;

use App\Models\Material;
use App\Models\Pedido;
use App\Models\PedidoHasMaterial;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateStatusPedidoAction
{

    public function execute(Pedido $pedido, String $new_status): bool
    {

        if ($pedido->status == $new_status)
            return false;

        if ($pedido->isFinalResultGiven())
            return false;

        if (
            $new_status == Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao') && !$pedido->isStatusNovo()
        )
            return false;


        return DB::transaction(function () use ($pedido, $new_status) {

            $result = $pedido->update([
                'status' => $new_status,
            ]);

            $action = new SendNotificationStatusPedidoUpdateAction();
            $action->execute($pedido);

            return $result;
        });
    }
}
