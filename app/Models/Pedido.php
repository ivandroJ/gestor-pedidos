<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'PEDIDO';
    public $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'total',
        'status',
        'solicitante_id',
    ];

    public $timestamps = true;

    public function solicitante(){

        return $this->belongsTo(Solicitante::class,'solicitante_id');
    }
}
