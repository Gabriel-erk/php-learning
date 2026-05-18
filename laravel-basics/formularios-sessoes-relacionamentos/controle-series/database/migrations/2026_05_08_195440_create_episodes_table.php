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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number'); // numero do episodio
            $table->foreignId('season_id')->constrained()->onDelete('cascade'); // mesma coisa de seasons, uma série for apagada na tabela series e ela tiver seu id presente em QUALQUER registro da tabela episodes, os registros da tabela episodes que possuiam vínculo com o registro na tabela series que foi apagado, TAMBÉM será apagado consequentemente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
