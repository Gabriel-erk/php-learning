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
        $mensagemStatus = session('mensagem.status');

        return view('usuarios.index', compact('usuarios', 'mensagemStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
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
                'email' => 'required|email|unique:usuarios,email',
                'celular' => 'required'
            ]);

            UsuarioTa::create([
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'senha' => Hash::make($request->senha),
                'email' => $request->email,
                'celular' => $request->celular
            ]);

            $request->session()->flash('mensagem.status', 'Usuário criado com sucesso.');

            return to_route('usuarios.index');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            $request->session()->flash('mensagem.status', "Erro ao criar usuário: $mensagemErro");
            return to_route('usuarios.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $usuario = UsuarioTa::findOrFail($id);

            return view('usuarios.show', compact('usuario'));
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            session()->flash('mensagem.status', "Não foi possível recuperar o usuário: {$mensagemErro}");

            return to_route('usuarios.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $usuario = UsuarioTa::findOrFail($id);

            return view('usuarios.edit', compact('usuario'));
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            session()->flash('mensagem.status', "Não foi possível recuperar o usuário: {$mensagemErro}");

            return to_route('usuarios.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nome' => 'required|min:5',
                'sobrenome' => 'required|min:5',
                'senha' => 'required|min:6',
                'email' => 'required|email|unique:usuarios,email,' . $id,
                'celular' => 'required'
            ]);

            $usuario = UsuarioTa::findOrFail($id);

            $usuario->update([
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'senha' => Hash::make($request->senha),
                'celular' => $request->celular
            ]);

            $request->session()->flash('mensagem.status', 'Usuário atualizado com sucesso!');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            $request->session()->flash('mensagem.status', "Não foi possível atualizar o usuário: {$mensagemErro}");
        }
        return to_route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            UsuarioTa::destroy($id);
            session()->flash('mensagem.status', 'Usuário deletado com sucesso!');

            return to_route('usuarios.index');
        } catch (\Throwable $th) {
            $mensagemErro = $th->getMessage();
            session()->flash('mensagem.status', "Não foi possível deletar o usuário {$mensagemErro}");

            return to_route('usuarios.index');
        }
    }
}
