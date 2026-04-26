<?php

use App\Http\Controllers\FilmeControllerTa;
use App\Http\Controllers\UsuarioControllerTa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('usuarios.index');
});


Route::resource('/pratica/usuarios', UsuarioControllerTa::class);
Route::resource('/pratica/filmes', FilmeControllerTa::class);