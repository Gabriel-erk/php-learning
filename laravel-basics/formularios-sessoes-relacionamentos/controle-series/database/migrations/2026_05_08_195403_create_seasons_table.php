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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            // um inteiro (integer) pequeno (tiny) e positivo (unsigned) onde o nome desse campo/coluna é numero para representar o número de séries que vou ter
            // $table->unsignedTinyInteger('numero');
            // trocando de numero para number para não ficar com coisas no projeto em português e outras em inlgês, apenas PADRONIZANDO tudo (number aqui faz referencia ao numero da temporada)
            $table->unsignedTinyInteger('number');
            // coluna ESTRANGEIRA de ID (foreignId) chamada 'series_id' que referência a coluna 'id' na tabela que estamos nos relacionando (series), laravel sabe qual é a tabela pois temos um método de relacionamento com a tabela series em nosso Model
            $table->foreignId('series_id')->constrained()->onDelete('cascade'); // ->onDelete('cascade') quer dizer que: toda vez que eu apagar um registro na coluna: series_id (chave estrangeira da tabela series) eu estarei apagando o registro (aqui na tabela seasons) vinculado ao id da série que foi apagada, logo: tenho um registro na tabela seasons com o id = 5 e ao lado ele possui a coluna: series_id = 2 (mostrando que a minha season com id 5 pertence a series com id = 2), caso eu apague o registro na tabela series com o id = 2, também apago a season com id = 5 na tabela seasons (já que o id = 5 na tabela seasons possuia a coluna series_id = 2 também)
            // este tipo é um tipo inteiro MAIOR(suporta mais bits que apenas um tipo inteiro) e seu valor é APENAS positivo (nosso ID na linha acima possui esse tipo também por debaixo dos panos) (unsigned == para entrar aqui número tem que ser sempre positivo)
            // $table->unsignedBigInteger('series_id');
            // coluna ESTRANGEIRA (foreign) chamada 'series_id' que referência(references) a coluna 'id' na tabela (on)'series'
            // $table->foreign('series_id')->references('id')->on('series');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
