<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    protected $fillable = [
        'number',
    ];

    // informando que o atributo público timestamps como falso após apagar ele da nossa migration para informar que não queremos saber quando cada episódio foi criado/alterado / informando que não vou usar os time_stamps
    public $timestamps = false;
    // season ao invés de 'seasons' pois essa classe/método que estamos agora (Episode) possui vínculo com APENAS UMA season, nós (classe episode) não temos vínculo com mais de UM registro da tabela/classe/modelo 'Season'
    public function season()
    {
        // cada episódio PERTENCE a apenas UMA temporadaa, cada episódio TEM apenas UMA temporada
        return $this->belongsTo(Season::class);
    }
}
