<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('responsaveis', function (Blueprint $table) {
            $table->id('idResponsavel');  // ID primário
            $table->string('nome', 100);
            $table->char('cpf', 11)->unique();
            $table->char('telefone', 11);
            $table->date('dataNascimento');
            $table->foreignId('idUsuario')->constrained('usuarios')->onDelete('cascade');  // Chave estrangeira
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responsaveis');
    }
};
