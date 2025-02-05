<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'PEDIDO';
    public $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'total',
        'status',
        'solicitante_id',
    ];

    public $timestamps = true;

    public function solicitante()
    {

        return $this->belongsTo(Solicitante::class, 'solicitante_id');
    }

    public function pedidoHasMateriais()
    {
        return $this->hasMany(PedidoHasMaterial::class, 'pedido_id');
    }

    public function isPermitido(): bool
    {
        return $this->total <= $this->solicitante->grupo->saldoPermitido;
    }

    public function isStatusNovo()
    {
        return $this->status == Config::get('constants.TIPOS_STATUS_PEDIDOS.novo');
    }

    public function isStatusAprovado()
    {
        return $this->status == Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado');
    }

    public function isStatusRejeitado()
    {
        return $this->status == Config::get('constants.TIPOS_STATUS_PEDIDOS.rejeitado');
    }

    public function isStatusEmRevisao()
    {
        return $this->status == Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao');
    }

    public function isStatusSolicitandoAlteracoes()
    {
        return $this->status == Config::get('constants.TIPOS_STATUS_PEDIDOS.alteracoes');
    }

    public function isWaitingAproval(): bool
    {
        return $this->isStatusEmRevisao() || $this->isStatusNovo();
    }

    public function isFinalResultGiven()
    {
        return $this->isStatusAprovado() || $this->isStatusRejeitado();
    }

    public function isYourAprovador(User $usuario): bool
    {
        return $this->solicitante->grupo->aprovador_id == $usuario->id;
    }
}
