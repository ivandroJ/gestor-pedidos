<?php

namespace App\Actions\Usuarios;

use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateUsuarioAction
{

    public function execute(String $nome, String $email, String $perfil, int $grupo_id = null): ?User
    {

        return DB::transaction(function () use ($nome, $email, $perfil, $grupo_id) {

            $password = Str::random(8);

            $usuario = User::create([
                'nome' => $nome,
                'email' => $email,
                'perfil' => $perfil,
                'password' => bcrypt($password),
                'reseted_password' => $password,
            ]);

            if (!$usuario)
                return DB::rollBack();

            //Se o usuário é solicitante
            if ($usuario->perfil == Config::get('constants.PERFIS.solicitante'))
                if (!Solicitante::create([
                    'usuario_id' => $usuario->id,
                    'grupo_id' => $grupo_id,
                ]))
                    return DB::rollBack();

            return $usuario;
        });
    }
}
