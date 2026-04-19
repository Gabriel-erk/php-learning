<?php

namespace App\Http\Controllers;

use App\Models\UsuarioTa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioControllerTa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = UsuarioTa::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('usuarios', compact('usuarios', 'mensagemSucesso'));
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
        try {
            $request->validate([
                'nome' => 'required|min:5',
                'sobrenome' => 'required|min:5',
                'senha' => 'required|min:6',
                'email' => 'required|email|unique:usuarios.email',
                'celular' => 'required'
            ]);

            UsuarioTa::create([
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'senha' => Hash::make($request->senha),
                'celular' => $request->celular
            ]);

            $request->session()->flash('mensagem.sucesso', 'Usuário criado com sucesso.');

            return to_route('usuarios.index');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            $request->session()->flash('mensagem.status', 'Erro ao criar usuário: $mensagemErro');
            return to_route('usuarios.index');
        }
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
