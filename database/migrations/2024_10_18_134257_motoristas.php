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
        Schema::create('motoristas', function (Blueprint $table) {
            $table->id('idMotorista'); // Primary key
            $table->string('nome', 100);
            $table->char('telefone', 11);
            $table->char('cpf', 11);
            $table->decimal('mensalidade', 8, 2);
            $table->date('dataNascimento');
            $table->unsignedBigInteger('idUsuario'); // Foreign key para Usuario
            $table->timestamps(); // created_at e updated_at

            // Definindo Foreign Key
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motoristas');
    }
};
