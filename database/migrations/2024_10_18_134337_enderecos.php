<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id('idEndereco');  // ID primário
            $table->char('cep', 9);
            $table->string('logradouro', 100);
            $table->integer('numero');
            $table->string('bairro', 45);
            $table->text('complemento')->nullable();
            $table->char('uf', 2);  // Sigla do estado
            $table->string('estado', 45);
            $table->timestamps();  // Campos created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
