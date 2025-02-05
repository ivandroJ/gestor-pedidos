<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'USUARIO';

    public $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'perfil',
        'reseted_password',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function primeiroNome(): String
    {
        return explode(' ', $this->nome)[0] ?? $this->nome;
    }

    public function solicitante()
    {
        return $this->hasOne(Solicitante::class, 'usuario_id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'aprovador_id');
    }

    public function isSolicitante()
    {
        return $this->perfil == Config::get('constants.PERFIS.solicitante');
    }
    public function isAprovador()
    {
        return $this->perfil == Config::get('constants.PERFIS.aprovador');
    }

    public function updatedAlredyWithinDay(): bool
    {
        return now()->diff($this->updated_at)->days <= 1;
    }
}
