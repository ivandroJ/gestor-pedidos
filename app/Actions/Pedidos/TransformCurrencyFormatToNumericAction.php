<?php

namespace App\Actions\Pedidos;

use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransformCurrencyFormatToNumericAction
{

    public function execute(String $value)
    {
        return Str::replace(',', '.', Str::remove('.', $value));
    }
}
