<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Override;

class Reserve extends Model
{
    // cada reserva possui apenas UM usuário, possui vínculo com apenas UM usuário
    public function user(){
        $this->belongsTo(User::class);
    }

    // cada reserva possui vínculo com apenas UM quarto room
    public function room(){
        $this->belongsTo(Room::class);
    }

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function(Builder $queryBuilder) {
            $queryBuilder->orderBy('start_time', 'asc');
        }); 
    }
}
