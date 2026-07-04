<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Series $series)
    {
        // seasons == collection do eloquent com vários objetos, caso chame $series->seasons() é o relacionamento
        // $seasons = $series->seasons;
        
        // este código abaixo faz com que eu traga todas as temporadas da minha série passada de parâmetro neste método aqui, onde acesso o método de relacionamento da série com suas temporadas: $series->seasons() e o WITH('episodes') faz com que cada temporada que eu esteja trazendo com $series->seasons() venha com seus respectivos episódios
        // get() no fim é apenas para que eu pegue o retorno destes dados no fim da 'query'
        // nome deste processo que traz as temporadas de uma série com seus respectivos episódios atraes do método de relacionamento de uma série: igger loading, que reduz a quantidade de SQL necessários para buscar as informations que vou usar (ótimo para performance)
        $seasons = $series->seasons()->with('episodes')->get();

        // realizando query SQL na minha tabela seasons para trazer as temporadas junto com o episódios episódios que cada uma tem de acordo com o ID da série que eu passei
        // $seasons = Season::query()  iniciando uma query na minha tabela seasons (query == algo como: select from, delete from...etc)
        // ->with('episodes') realizando o igger loading aqui (para trazer todos os episodios de cada temporada)
        // ->where('season_id', $series) ONDE a coluna season_id da minha tabela seasons é igual ao valor da minha váriavel $series (que possui o valor de um ID da tabela series)
        // ->get();

        return view('seasons.index')->with('seasons', $seasons)->with('series', $series);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
