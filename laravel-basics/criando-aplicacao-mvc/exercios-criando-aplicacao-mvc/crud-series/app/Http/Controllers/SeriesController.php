<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class SeriesController extends Controller
{
    public function indexExercicioA()
    {
        // orderBy pede 2 parâmetros, por qual campo da tabela quero ordenar (no meu caso, campo nome) e o segundo a FORMA q isso vai acontecer, por padrão vem asc == A-Z, mas especifiquei para ficar mais claro
        // caso fosse apenas o queryBuilder (== query()) + o orderBy(parametrosAqui) me retornaria apenas uma query para a váriavel $series, porém estou usando ->get() no final para garantir que pegarei o retorno de toda essa consulta (== query), por fim, me retornando uma Collection (lista de dados do banco de dados, onde cada objeto possuem funções/métodos) para váriavel $series
        $series = Serie::query()->orderBy('nome', 'asc')->get();

        // compact se passa o nome da váriavel/colleção entre '' e ele irá procurar dentro do método atual (index) uma váriavel com o mesmo nome, por fim, passando o nome/valor da variavel que colocamos nas suas '' como parâmetro para a view em questão (no caso, series.index)
        return view('series.index', compact('series'));
    }

    public function criarExercicioA()
    {
        return view('series.criar');
    }

    public function salvarExercicioA(Request $request)
    {
        $nomeSerie = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nomeSerie;

        $serie->save();
        // dando certo ou errado, retorno para a página atual (pois se mandar para a home vai dar um erro dizendo que a váriavel $series não existe)
        return view('series.criar');
    }

    public function editarExercicioA(int $id)
    {
        $serie = Serie::find($id);

        return view('series.editar', compact('serie'));
    }

    // recebo uma requisição (informações do formulário/informações que irei substituir da série atual) e o id da série que irei atualizar, pois preciso encontra-la no banco para atualizar os campos selecionados
    public function atualizarExercicioA(Request $request, int $id)
    {
        // aqui só vou receber o nome da série para atualizar, então posso ir atrás apenas desse campo
        $novoNomeSerie = $request->input('nome');
        // encontro a série no banco de dados para substituir o nome dela no banco pelo novo
        $serie = Serie::find($id);
        $serie->nome = $novoNomeSerie;
        $serie->save();

        return redirect('/series');
    }

    public function destruirExercicioA(int $id) {
        Serie::destroy($id);

        return redirect('/series');
    }
}