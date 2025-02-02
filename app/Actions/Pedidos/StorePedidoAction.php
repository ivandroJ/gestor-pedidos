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

class StorePedidoAction
{

    public function execute(array $materiais): ?Pedido
    {
        return DB::transaction(function () use ($materiais) {

            $pedido = Pedido::create([
                'total' => array_sum(array_column($materiais, 'subTotal')),
                'solicitante_id' => request()->user()->solicitante->id,
            ]);

            if (!$pedido)
                return DB::rollBack();

            foreach ($materiais as $material_pedido) {
                $material = Material::create(
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
