<?php

namespace App\Actions\Pedidos;

use App\Models\Material;
use App\Models\Pedido;
use App\Models\PedidoHasMaterial;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateStatusPedidoAction
{

    public function execute(Pedido $pedido, String $new_status): bool
    {
        if (!$this->isFactsChecked($pedido, $new_status))
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

    private function isFactsChecked(Pedido $pedido, String $new_status): bool
    {
        if ($pedido->isFinalResultGiven() || ($pedido->status == $new_status))
            return false;

        switch ($new_status) {
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado'):
                return $pedido->isYourAprovador(Auth::user())
                    && $pedido->isPermitido();
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.rejeitado'):
                return $pedido->isYourAprovador(Auth::user());
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.alteracoes'):
                return $pedido->isYourAprovador(Auth::user());
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.novo'):
                return $pedido->isStatusSolicitandoAlteracoes();
            case Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao'):
                return $pedido->isYourAprovador(Auth::user()) &&
                    $pedido->isStatusNovo();
            default:
                return false;
        }
    }
}
