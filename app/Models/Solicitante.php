<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;
    
    protected $table = 'SOLICITANTE';
    public $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'usuario_id',
        'grupo_id',
    ];

    public $timestamps = false;

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'solicitante_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}
