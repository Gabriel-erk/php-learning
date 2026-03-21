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
        Schema::create('series', function (Blueprint $table) {
            // campo id já é criado automaticamente como chave primária auto-incrementável
            $table->id();
            // criando um campo do tipo: string, chamando esse campo de: nome e definindo que o tamanho máximo de caracteres que ele aceita são 128
            $table->string('nome', length:128);
            // cria os campos de inserido (created_at == guarda o momento da criação da criação daquele registro nessa tabela, como: momento que a séries com ID == 1 foi inserida aqui na tabela) e atualizado (updated_at == mesmo conceito do created_at, porém, o momento que QUALQUER campo daquele registro foi ATUALIZADO na nossa tabela atual (series))
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
