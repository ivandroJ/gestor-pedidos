<?php

namespace App\Actions\Usuarios;

use Illuminate\Support\Str;

class GeneratePasswordUsuarioAction
{

    public function execute(): String
    {
        return Str::random(8);
    }
}
