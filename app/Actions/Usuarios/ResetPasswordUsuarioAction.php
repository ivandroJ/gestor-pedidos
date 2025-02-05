<?php

namespace App\Actions\Usuarios;

use App\Models\User;
use Illuminate\Support\Str;

class ResetPasswordUsuarioAction
{

    public function execute(User $usuario): bool
    {
        $generatePasswordAction = new GeneratePasswordUsuarioAction();

        $new_password = $generatePasswordAction->execute();

        $result = $usuario->update([
            'password' => bcrypt($new_password),
            'reseted_password' => $new_password,
        ]);

        if ($result) {
            $sendNotificationAction = new SendUsuarioCredentialsAction();
            $sendNotificationAction->execute($usuario);
        }

        return $result;
    }
}
