<?php

use App\Models\Solicitante;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('PEDIDO', function (Blueprint $table) {
            $table->id();
            $table->decimal('total');
            $table->enum('status', Config::get('constants.TIPOS_STATUS_PEDIDOS'))
                ->default('Novo');

            $table->foreignIdFor(Solicitante::class, 'solicitante_id')
                ->references('id')
                ->on('SOLICITANTE')
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PEDIDO');
    }
};
