<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    protected $table = 'MATERIAL';
    public $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = [
        'nome',
        'preco',
    ];

    public $timestamps = false;
}
