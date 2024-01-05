<?php

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
        Schema::create('portarias', function (Blueprint $table) {
            $table->id();
            $table->string('nome_paciente');
            $table->string('unidade_internacao');
            $table->longText('observacao')->nullable();
            $table->string('parentesco_visitante');

            $table->foreignId('visitante_id')->constrained()->onUpdate('CASCADE');
            $table->foreignId('user_id')->constrained()->onUpdate('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portarias');
    }
};
