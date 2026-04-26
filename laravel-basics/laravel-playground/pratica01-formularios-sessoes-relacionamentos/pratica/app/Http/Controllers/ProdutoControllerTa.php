<?php

namespace App\Http\Controllers;

use App\Models\ProdutoTa;
use Illuminate\Http\Request;

class ProdutoControllerTa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = ProdutoTa::all();
        $mensagemStatus = session('mensagem.status');

        return view('produtos.index', compact('produtos', 'mensagemStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'preco' => 'required|numeric|min:0',
                'descricao' => 'nullable|string',
                'ativo' => 'boolean'
            ]);

            ProdutoTa::create([
                'nome' => $request->nome,
                'preco' => $request->preco,
                'descricao' => $request->descricao,
                'ativo' => $request->ativo
            ]);

            $request->session()->flash('mensagem.status', 'Produto criado com sucesso!');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();

            session()->flash('mensagem.status', "Erro ao criar produto: {$mensagemErro}");
        }
        return to_route('produtos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $produto = ProdutoTa::findOrFail($id);

            return view('produtos.show', compact('produto'));
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();

            session()->flash('mensagem.status', "Não foi possível recuperar o produto: {$mensagemErro}");
            return to_route('produtos.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $produto = ProdutoTa::findOrFail($id);

            return view('produtos.edit', compact('produto'));
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();

            session()->flash('mensagem.status', "Não foi possível recuperar o produto: {$mensagemErro}");
            return to_route('produtos.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'preco' => 'required|numeric|min:0',
                'descricao' => 'nullable|string',
                'ativo' => 'boolean'
            ]);

            $produto = ProdutoTa::findOrFail($id);

            $produto->update([
                'nome' => $request->nome,
                'preco' => $request->preco,
                'descricao' => $request->descricao,
                'ativo' => $request->ativo
            ]);

            $request->session()->flash('mensagem.status', 'Produto atualizado com sucesso!');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();

            $request->session()->flash('mensagem.status', "Não foi possível atualizar o produto: {$mensagemErro}");
        }
        return to_route('produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ProdutoTa::destroy($id);

            session()->flash('mensagem.status', 'Produto deletado com sucesso!');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();

            session()->flash('mensagem.status', "Não foi possível deletar o produto: {$mensagemErro}");
        }
        return to_route('produtos.index');
    }
}
