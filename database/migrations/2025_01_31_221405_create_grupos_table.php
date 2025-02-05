<?php

use App\Models\User;
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
        Schema::create('GRUPO', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->decimal('saldoPermitido',16);
            $table->foreignIdFor(User::class, 'aprovador_id')
                ->references('id')
                ->on('USUARIO')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('GRUPO');
    }
};
