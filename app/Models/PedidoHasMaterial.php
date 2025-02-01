<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoHasMaterial extends Model
{
    protected $table = 'PEDIDO_HAS_MATERIAL';

    protected $fillable = [
        'pedido_id',
        'material_id',
        'quantidade',
        'subTotal',
    ];

    public $timestamps = false;
}
