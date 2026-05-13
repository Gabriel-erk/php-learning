<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaFormRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaFormRequest $request)
    {
        try {
            $categoria = Categoria::create($request->all());
            return to_route('series.index')->with('mensagem.status', "Categoria: '$categoria->nome' criada com sucesso!");
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            return to_route('series.index')->with('mensagem.status', "Não foi possível criar a categoria: '$mensagemErro'");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaFormRequest $request, Categoria $categoria)
    {
        try {
            $categoria->fill($request->all());
            // como o método fill por si só não realiza um salvamento no banco de dados, estou usando o save manual
            $categoria->save();

            return to_route('series.index')->with('mensagem.status', "Categoria: '$categoria->nome' atualizada com sucesso!");
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            return to_route('series.index', "Não foi possível atualizar a categoria: '$mensagemErro'");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Categoria::destroy($id);
            return to_route('categorias.index')->with('mensagem.status', 'Categoria deletada com sucesso!');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            return to_route('categorias.index')->with('mensagem.status', "Não foi possível deletar a categoria: '$mensagemErro'");
        }
    }
}
