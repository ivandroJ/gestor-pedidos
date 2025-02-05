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

class UpdatePedidoTest extends TestCase
{
    use RefreshDatabase;

    protected UpdateStatusPedidoAction $updateStatusPedidoAction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->updateStatusPedidoAction = new UpdateStatusPedidoAction();
    }


    public function test_should_update_status_aprovado()
    {
        // Define um saldo permitido para o grupo
        $saldoPermitido = 1900000.00;

        // Cria um usuário aprovador com um grupo associado e o saldo permitido
        $userAprovador = User::factory()
            ->has(Grupo::factory(1, [
                'saldoPermitido' => $saldoPermitido,
            ]))
            ->create([
                'perfil' => Config::get('constants.PERFIS.aprovador'),
            ]);

        // Autentica o usuário aprovador
        $this->actingAs($userAprovador);

        // Obtém o grupo associado ao usuário aprovador
        $grupo = $userAprovador->grupos->first();

        // Cria um usuário solicitante associado ao grupo
        $userSolicitante = User::factory()
            ->has(Solicitante::factory(1, [
                'grupo_id' => $grupo->id,
            ]))->create([
                'perfil' => Config::get('constants.PERFIS.solicitante')
            ]);

        // Cria um pedido com status "revisão" e um total dentro do saldo permitido
        $pedido = Pedido::factory()
            ->create([
                'total' => fake()->randomFloat(16, 1, $saldoPermitido),
                'solicitante_id' => $userSolicitante->solicitante->id,
                'status' => Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao')
            ]);

        // Define o novo status como "aprovado"
        $newStatus = Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado');

        // Executa a ação de atualizar o status do pedido
        $result = $this->updateStatusPedidoAction->execute($pedido, $newStatus);

        // Verifica se a ação foi bem-sucedida
        $this->assertTrue($result); // Confirma que a ação retornou true
        $this->assertEquals($newStatus, $pedido->fresh()->status); // Verifica se o status do pedido foi atualizado
    }

    public function test_shouldnt_allow_pedido_higher_saldo_than_grupo()
    {
        // Define um saldo permitido para o grupo
        $saldoPermitido = 400.00;

        // Cria um usuário aprovador com um grupo associado e o saldo permitido
        $userAprovador = User::factory()
            ->has(Grupo::factory(1, [
                'saldoPermitido' => $saldoPermitido,
            ]))
            ->create([
                'perfil' => Config::get('constants.PERFIS.aprovador'),
            ]);

        // Autentica o usuário aprovador
        $this->actingAs($userAprovador);

        // Obtém o grupo associado ao usuário aprovador
        $grupo = $userAprovador->grupos->first();

        // Cria um usuário solicitante associado ao grupo
        $userSolicitante = User::factory()
            ->has(Solicitante::factory(1, [
                'grupo_id' => $grupo->id,
            ]))->create([
                'perfil' => Config::get('constants.PERFIS.solicitante')
            ]);

        // Define o status inicial do pedido como "revisão"
        $status = Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao');

        // Cria um pedido com um total maior que o saldo permitido
        $pedido = Pedido::factory()
            ->create([
                'total' => fake()->randomFloat(16, $saldoPermitido + 0.01),
                'solicitante_id' => $userSolicitante->solicitante->id,
                'status' => $status,
            ]);

        // Define o novo status como "aprovado"
        $newStatus = Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado');

        // Executa a ação de atualizar o status do pedido
        $result = $this->updateStatusPedidoAction->execute($pedido, $newStatus);

        // Verifica se a ação falhou
        $this->assertFalse($result); // Confirma que a ação retornou false
        $this->assertEquals($status, $pedido->fresh()->status); // Verifica se o status do pedido não foi alterado
    }



    public function test_shouldnt_accept_aprove_pedido_by_solicitante()
    {
        // Define um saldo permitido para o grupo
        $saldoPermitido = 19000000.00;

        // Cria um usuário aprovador com um grupo associado e o saldo permitido
        $userAprovador = User::factory()
            ->has(Grupo::factory(1, [
                'saldoPermitido' => $saldoPermitido,
            ]))
            ->create([
                'perfil' => Config::get('constants.PERFIS.aprovador'),
            ]);

        // Obtém o grupo associado ao usuário aprovador
        $grupo = $userAprovador->grupos->first();

        // Cria um usuário solicitante associado ao grupo
        $userSolicitante = User::factory()
            ->has(Solicitante::factory(1, [
                'grupo_id' => $grupo->id,
            ]))->create([
                'perfil' => Config::get('constants.PERFIS.solicitante')
            ]);

        // Autentica o usuário solicitante
        $this->actingAs($userSolicitante);

        // Define o status inicial do pedido como "revisão"
        $status = Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao');

        // Cria um pedido com um total dentro do saldo permitido
        $pedido = Pedido::factory()
            ->create([
                'total' => fake()->randomFloat(16, 0.01, $saldoPermitido),
                'solicitante_id' => $userSolicitante->solicitante->id,
                'status' => $status,
            ]);

        // Define o novo status como "aprovado"
        $newStatus = Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado');

        // Executa a ação de atualizar o status do pedido
        $result = $this->updateStatusPedidoAction->execute($pedido, $newStatus);

        // Verifica se a ação falhou
        $this->assertFalse($result); // Confirma que a ação retornou false
        $this->assertEquals($status, $pedido->fresh()->status); // Verifica se o status do pedido não foi alterado
    }

    public function test_shouldnt_accept_aprove_pedido_by_another_aprovador()
    {
        // Define um saldo permitido para o grupo
        $saldoPermitido = 19000000.00;

        // Cria um usuário aprovador com um grupo associado e o saldo permitido
        $userAprovador = User::factory()
            ->has(Grupo::factory(1, [
                'saldoPermitido' => $saldoPermitido,
            ]))
            ->create([
                'perfil' => Config::get('constants.PERFIS.aprovador'),
            ]);

        // Cria outro usuário aprovador
        $userAprovador2 = User::factory()
            ->create([
                'perfil' => Config::get('constants.PERFIS.aprovador'),
            ]);

        // Obtém o grupo associado ao primeiro usuário aprovador
        $grupo = $userAprovador->grupos->first();

        // Cria um usuário solicitante associado ao grupo
        $userSolicitante = User::factory()
            ->has(Solicitante::factory(1, [
                'grupo_id' => $grupo->id,
            ]))->create([
                'perfil' => Config::get('constants.PERFIS.solicitante')
            ]);

        // Autentica o segundo usuário aprovador
        $this->actingAs($userAprovador2);

        // Define o status inicial do pedido como "revisão"
        $status = Config::get('constants.TIPOS_STATUS_PEDIDOS.revisao');

        // Cria um pedido com um total dentro do saldo permitido
        $pedido = Pedido::factory()
            ->create([
                'total' => fake()->randomFloat(16, 0.01, $saldoPermitido),
                'solicitante_id' => $userSolicitante->solicitante->id,
                'status' => $status,
            ]);

        // Define o novo status como "aprovado"
        $newStatus = Config::get('constants.TIPOS_STATUS_PEDIDOS.aprovado');

        // Executa a ação de atualizar o status do pedido
        $result = $this->updateStatusPedidoAction->execute($pedido, $newStatus);

        // Verifica se a ação falhou
        $this->assertFalse($result); // Confirma que a ação retornou false
        $this->assertEquals($status, $pedido->fresh()->status); // Verifica se o status do pedido não foi alterado
    }
}
