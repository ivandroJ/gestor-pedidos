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

class UpdatePedidoAction
{

    public function execute(Pedido $pedido, array $materiais): Pedido
    {
        return DB::transaction(function () use ($pedido, $materiais) {


            $result = $pedido->update([
                'total' => array_sum(array_column($materiais, 'subTotal')),
            ]);

            $updateStatusAction = new UpdateStatusPedidoAction();
            $updateStatusAction->execute($pedido, Config::get('constants.TIPOS_STATUS_PEDIDOS.novo'));

            if (!$result)
                return DB::rollBack();

            $pedido->pedidoHasMateriais()->delete();

            foreach ($materiais as $material_pedido) {

                $material =
                    isset($material_pedido['material_id']) ?
                    Material::find($material_pedido['material_id']) :
                    Material::create(
                        [
                            'nome' => $material_pedido['nome'],
                            'preco' => $material_pedido['preco'],
                        ]
                    );

                if (!$material)
                    return DB::rollBack();

                PedidoHasMaterial::create([
                    'pedido_id' => $pedido->id,
                    'material_id' => $material->id,
                    'quantidade' => $material_pedido['quantidade'],
                    'subTotal' => $material_pedido['subTotal'],
                ]);
            }

            return $pedido;
        });
    }
}
