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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id('idSolicitacao'); // Primary key
            $table->unsignedBigInteger('idResponsavel'); // Foreign key para Responsável
            $table->unsignedBigInteger('idMotorista');   // Foreign key para Motorista
            $table->unsignedBigInteger('idAluno')->nullable(); // Foreign key para Aluno
            $table->string('status', 45)->default('pendente'); // Status da solicitação
            $table->timestamps(); // created_at e updated_at

            // Definindo chaves estrangeiras
            $table->foreign('idResponsavel')->references('idResponsavel')->on('responsaveis')->onDelete('cascade');
            $table->foreign('idMotorista')->references('idMotorista')->on('motoristas')->onDelete('cascade');
            $table->foreign('idAluno')->references('idAluno')->on('alunos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
