<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
