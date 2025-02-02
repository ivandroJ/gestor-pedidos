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

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
