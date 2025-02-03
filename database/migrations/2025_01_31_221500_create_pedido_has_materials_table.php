<?php

use App\Models\Material;
use App\Models\Pedido;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('PEDIDO_HAS_MATERIAL', function (Blueprint $table) {
            $table->foreignIdFor(Pedido::class, 'pedido_id')
                ->references('id')
                ->on('PEDIDO')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(Material::class, 'material_id')
                ->references('id')
                ->on('MATERIAL')
                ->cascadeOnUpdate();

            $table->integer('quantidade');
            $table->decimal('subTotal');

            $table->primary(['pedido_id', 'material_id'], 'PK_PED_MAT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PEDIDO_HAS_MATERIAL');
    }
};
