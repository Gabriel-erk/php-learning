<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function reserves(){
        $this->hasMany(Reserve::class, 'user_id');
    }
}
