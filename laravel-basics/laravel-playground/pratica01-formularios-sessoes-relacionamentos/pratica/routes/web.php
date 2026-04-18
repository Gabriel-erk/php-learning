<?php

use App\Http\Controllers\UsuarioControllerTa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/pratica/usuarios', UsuarioControllerTa::class);