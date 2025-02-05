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

class CreatePedidoTest extends TestCase
{
    use RefreshDatabase;

    protected StorePedidoAction $storePedidoAction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->storePedidoAction = new StorePedidoAction();
    }

    public function test_should_create_new_pedido_with_correct_total_when_given_valid_materiais()
    {
        // Cria um usuário aprovador com um grupo associado e um saldo permitido
        $userAprovador = User::factory()->has(Grupo::factory(1, [
            'saldoPermitido' => fake()->randomFloat(16, 100),
        ]))->create([
            'perfil' => Config::get('constants.PERFIS.aprovador')
        ]);

        // Obtém o grupo associado ao usuário aprovador
        $grupo = $userAprovador->grupos()->first();

        // Cria um usuário solicitante
        $userSolicitante = User::factory()->create([
            'perfil' => Config::get('constants.PERFIS.solicitante'),
        ]);

        // Cria um solicitante associado ao usuário solicitante e ao grupo
        $solicitante = Solicitante::factory()->create([
            'usuario_id' => $userSolicitante->id,
            'grupo_id' => $grupo->id
        ]);

        // Autentica o usuário solicitante para simular uma requisição autenticada
        $this->actingAs($userSolicitante);

        // Define os materiais que serão usados no pedido
        $materiais = [
            [
                'nome' => 'Material 1',
                'preco' => 10.00,
                'quantidade' => 2,
                'subTotal' => 20.00
            ],
            [
                'nome' => 'Material 2',
                'preco' => 15.00,
                'quantidade' => 3,
                'subTotal' => 45.00
            ]
        ];

        // Executa a ação de criar o pedido
        $pedido = $this->storePedidoAction->execute($materiais, $solicitante, $grupo);

        // Verifica se o pedido foi criado corretamente
        $this->assertInstanceOf(Pedido::class, $pedido); // Confirma que o objeto retornado é uma instância de Pedido
        $this->assertEquals(65.00, $pedido->total); // Verifica se o total do pedido está correto
        $this->assertEquals($solicitante->id, $pedido->solicitante_id); // Verifica se o solicitante está associado ao pedido
        $this->assertEquals(Config::get('constants.TIPOS_STATUS_PEDIDOS.novo'), $pedido->status); // Verifica se o status do pedido é "novo"

        // Verifica se o pedido foi persistido no banco de dados
        $this->assertDatabaseHas('PEDIDO', [
            'id' => $pedido->id,
            'total' => 65.00,
            'solicitante_id' => $solicitante->id
        ]);

        // Verifica se os materiais foram persistidos no banco de dados
        $this->assertDatabaseHas('MATERIAL', [
            'nome' => 'Material 1',
            'preco' => 10.00
        ]);

        $this->assertDatabaseHas('MATERIAL', [
            'nome' => 'Material 2',
            'preco' => 15.00
        ]);

        // Verifica se a relação entre o pedido e os materiais foi persistida corretamente
        $this->assertDatabaseHas('PEDIDO_HAS_MATERIAL', [
            'pedido_id' => $pedido->id,
            'quantidade' => 2,
            'subTotal' => 20.00
        ]);

        $this->assertDatabaseHas('PEDIDO_HAS_MATERIAL', [
            'pedido_id' => $pedido->id,
            'quantidade' => 3,
            'subTotal' => 45.00
        ]);
    }
}
