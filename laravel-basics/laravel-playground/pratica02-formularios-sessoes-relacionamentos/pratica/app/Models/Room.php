<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function reserves(){
        $this->hasMany(Reserve::class, 'room_id'); // cada sala pode ter VÁRIAS reservas ligadas a ela
    }
}
