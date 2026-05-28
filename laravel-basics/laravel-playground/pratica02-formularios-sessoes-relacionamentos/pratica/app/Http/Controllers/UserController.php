<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            return view('users.index', compact('users'))->with('message.status');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('users.index')->with('message.status', "Não foi possível recuperar os usuários '{$errorMessage}'");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $user = User::create()->fill($request->all());
            // tenho que salvar manualmente pois estou usando o método fill() na linha acima e por conta disso o métod não é salvo automaticamente
            $user->save();
            return to_route('users.index')->with('message.status', "Usuário '{$user->name}' criado com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('users.index')->with('message.status', "Não foi possível criar o usuário '{$errorMessage}'");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $user->update($request->all());
            return to_route('users.index')->with('message.status', "Usuário '{$user->name}' atualizado com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('users.index')->with('message.status', "Não foi possível atualizar o usuário: '{$errorMessage}'.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return to_route('users.index', "Usuário: '{$user->name}' deletado com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('users.index')->with('message.status', "Não foi possível excluir o usuário: '{$user->name}', Erro: '{$errorMessage}'");
        }
    }
}
