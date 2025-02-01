<?php

use App\Models\Grupo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('SOLICITANTE', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class, 'usuario_id')
                ->references('id')
                ->on('USUARIO')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(Grupo::class, 'grupo_id')
                ->references('id')
                ->on('GRUPO')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SOLICITANTE');
    }
};
