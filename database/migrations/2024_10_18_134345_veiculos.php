<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id('idVeiculo');  // ID primário
            $table->char('placa', 7);
            $table->string('modelo', 45);
            $table->integer('capacidade');
            $table->year('ano');
            $table->string('marca', 45);
            $table->foreignId('idMotorista')->constrained('motoristas')->onDelete('cascade');  // Chave estrangeira
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
