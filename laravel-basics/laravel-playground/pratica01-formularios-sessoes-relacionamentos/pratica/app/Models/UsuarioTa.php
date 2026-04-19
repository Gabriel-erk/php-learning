<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTa extends Model
{
    protected $table = 'usuarios';
    protected $fillable = [
        'nome',
        'sobrenome',
        'senha',
        'email',
        'celular'
    ];
}
