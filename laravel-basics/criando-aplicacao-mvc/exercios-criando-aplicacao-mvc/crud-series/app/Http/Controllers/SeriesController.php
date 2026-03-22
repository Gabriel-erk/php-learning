<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class SeriesController extends Controller
{
    public function index()
    {
        // orderBy pede 2 parâmetros, por qual campo da tabela quero ordenar (no meu caso, campo nome) e o segundo a FORMA q isso vai acontecer, por padrão vem asc == A-Z, mas especifiquei para ficar mais claro
        // caso fosse apenas o queryBuilder (== query()) + o orderBy(parametrosAqui) me retornaria apenas uma query para a váriavel $series, porém estou usando ->get() no final para garantir que pegarei o retorno de toda essa consulta (== query), por fim, me retornando uma Collection (lista de dados do banco de dados, onde cada objeto possuem funções/métodos) para váriavel $series
        $series = Serie::query()->orderBy('nome', 'asc')->get();

        return view('series.index');
    }

    public function create(){
        return view('series.criar');
    }
}
