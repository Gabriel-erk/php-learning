<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    // no ingles, a palavra: series == série, pois no inglês, por mais que 'series' pareća estar no plural, no inglês, a palavra 'series' é equivalente a série no português, ou seja, 'series' == série
    public function series()
    {
        // relacionamento "inverso" agora, uma Season (temporada) pertence a uma série, uma Season TEM uma série e nada mais
        return $this->belongsTo(Serie::class);
    }

    public function episodes()
    {
        // UMA temporada, possui VÁRIOS episódios
        return $this->hasMany(Episode::class);aaaa
    }
}
