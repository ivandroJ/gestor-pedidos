<?php

namespace Tests\Unit;

use App\Actions\Pedidos\StorePedidoAction;
use App\Actions\Pedidos\UpdateStatusPedidoAction;
use App\Models\Grupo;
use App\Models\Material;
use App\Models\Pedido;
use App\Models\PedidoHasMaterial;
use App\Models\Solicitante;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_home()
    {
        // Faz uma requisição GET para a rota /inicio sem autenticação
        $response = $this->get('/inicio');

        // Verifica se o usuário foi redirecionado para a página de login
        $response->assertRedirect('/login');

    }
}
