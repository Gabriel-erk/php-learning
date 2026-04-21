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

            $request->session()->flash('mensagem.status', 'Usuário criado com sucesso!');

            return to_route('filmes.index');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            $request->session()->flash('mensagem.status', "Erro ao criar usuário: $mensagemErro");

            return to_route('filmes.index');
        }
    }

    public function edit(string $id)
    {
        try {
            $filme = FilmeTa::findOrFail($id);
            return to_route('filmes.edit');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            session()->flash('mensagem.status', "Erro ao encontrar usuário: $mensagemErro");

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

            $filme::update([]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(string $id)
    {
        try {
            FilmeTa::destroy($id);
            session()->flash('mensagem.status', 'Filme excluído com sucesso.');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            session()->flash('mensagem.status', "Não foi possível deletar o usuário: {$mensagemErro}");
        }
        return to_route('filmes.index');
    }
}
