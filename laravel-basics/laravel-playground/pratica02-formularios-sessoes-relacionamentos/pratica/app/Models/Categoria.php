<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Override;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'descricao'
    ];  

    #[Override]
    protected static function booted()
    {
        self::addGlobalScope('ordered', function(Builder $queryBuilder){
            $queryBuilder->orderBy('nome', 'asc');
        }); 
    }
}
