<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('escolas', function (Blueprint $table) {
            $table->id('idEscola');  // ID primário
            $table->string('nome', 75);
            $table->foreignId('idEndereco')->constrained('enderecos')->onDelete('cascade');  // Chave estrangeira
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escolas');
    }
};
