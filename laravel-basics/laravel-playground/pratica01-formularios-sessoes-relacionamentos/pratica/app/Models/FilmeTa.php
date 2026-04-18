<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmeTa extends Model
{
    // linha para especificar para o laravel que o nome da tabela é "filmes", não "FilmeTas" como ele estava procurando devido a seu padrão de procurar por tabelas com o nome no plural do nome do Model
    protected $table = 'filmes';
    protected $fillable = [
        'nome',
        'genero',
        'duracaoEmMinutos'
    ];
}
