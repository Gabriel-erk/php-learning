<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoTa extends Model
{
    protected $table = 'produtos';
    protected $fillable = [
        'nome',
        'preco',
        'descricao',
    ];
}
