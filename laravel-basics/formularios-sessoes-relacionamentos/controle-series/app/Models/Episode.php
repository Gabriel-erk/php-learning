<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    // season ao invés de 'seasons' pois essa classe/método que estamos agora (Episode) possui vínculo com APENAS UMA season, nós (classe episode) não temos vínculo com mais de UM registro da tabela/classe/modelo 'Season'
    public function season()
    {
        // cada episódio PERTENCE a apenas UMA temporadaa, cada episódio TEM apenas UMA temporada
        return $this->belongsTo(Season::class);
    }

}
