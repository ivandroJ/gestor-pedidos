<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'GRUPO';
    public $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'nome',
        'saldoPermitido',
        'aprovador_id',
    ];

    public $timestamps = false;

    public function solicitante()
    {
        return $this->hasOne(Solicitante::class, 'grupo_id');
    }

    public function pedidos()
    {
        return $this->hasManyThrough(Pedido::class, Solicitante::class, 'grupo_id', 'solicitante_id');
    }

    public function aprovador()
    {
        return $this->belongsTo(User::class, 'aprovador_id');
    }
}
