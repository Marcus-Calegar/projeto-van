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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id('idAluno'); // Primary key
            $table->string('nome', 100);
            $table->date('dataNascimento');
            $table->unsignedBigInteger('idResponsavel'); // Foreign key para Responsável
            $table->unsignedBigInteger('idEscola');      // Foreign key para Escola
            $table->unsignedBigInteger('idEndereco');    // Foreign key para Endereco
            $table->unsignedBigInteger('idVeiculo');     // Foreign key para Veiculo
            $table->unsignedBigInteger('idUsuario');     // Foreign key para Usuario
            $table->timestamps(); // created_at e updated_at

            // Definindo Foreign Keys
            $table->foreign('idResponsavel')->references('idResponsavel')->on('responsaveis')->onDelete('cascade');
            $table->foreign('idEscola')->references('idEscola')->on('escolas')->onDelete('cascade');
            $table->foreign('idEndereco')->references('idEndereco')->on('enderecos')->onDelete('cascade');
            $table->foreign('idVeiculo')->references('idVeiculo')->on('veiculos')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
