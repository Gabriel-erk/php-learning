<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FilmeTa;

class FilmeControllerTa extends Controller
{
    public function index()
    {
        $filmes = FilmeTa::all();

        return view('filmes.index', compact('filmes'));
    }

    public function create()
    {
        return to_route('filmes.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|min:4',
                'genero' => 'required|min:4',
                'duracaoEmMinutos' => 'required|integer'
            ]);

            FilmeTa::create([
                'nome' => $request->nome,
                'genero' => $request->genero,
                'duracaoEmMinutos' => $request->duracaoEmMinutos
            ]);

            $request->session()->flash('mensagem.status', 'Filme criado com sucesso!');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            $request->session()->flash('mensagem.status', "Erro ao criar filme: $mensagemErro");
        }
        return to_route('filmes.index');
    }

    public function edit(string $id)
    {
        try {
            $filme = FilmeTa::findOrFail($id);
            return view('filmes.edit', compact('filme'));
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            session()->flash('mensagem.status', "Erro ao encontrar filme: $mensagemErro");

            return to_route('filmes.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nome' => 'required|min:4',
                'genero' => 'required|min:4',
                'duracaoEmMinutos' => 'required|integer'
            ]);

            $filme = FilmeTa::findOrFail($id);

            $filme::update([
                'nome' => $request->nome,
                'genero' => $request->genero,
                'duracaoEmMinutos' => $request->duracaoEmMinutos
            ]);

            $request->session()->flash('mensagem.status', 'Filme atualizado com sucesso.');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            $request->session()->flash('mensagem.status', "Não foi possível atualizar as informações do filme: {$mensagemErro}");
        }
        return to_route('filmes.index');
    }

    public function destroy(string $id)
    {
        try {
            FilmeTa::destroy($id);
            session()->flash('mensagem.status', 'Filme excluído com sucesso.');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            session()->flash('mensagem.status', "Não foi possível deletar o filme: {$mensagemErro}");
        }
        return to_route('filmes.index');
    }
}
