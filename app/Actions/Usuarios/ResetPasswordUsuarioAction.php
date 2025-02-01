<?php

namespace App\Actions\Usuarios;

use App\Models\User;
use Illuminate\Support\Str;

class ResetPasswordUsuarioAction
{

    public function execute(User $usuario): bool
    {
        $action = new GeneratePasswordUsuarioAction();

        $new_password = $action->execute();

        return $usuario->update([
            'password' => bcrypt($new_password),
            'reseted_password' => $new_password,
        ]);
    }
}
