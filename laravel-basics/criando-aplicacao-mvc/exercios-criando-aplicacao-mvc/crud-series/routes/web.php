<?php

use App\Http\Controllers\SeriesControllerC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', [SeriesControllerC::class, 'indexExercicioA']);
Route::get('/series/criar', [SeriesControllerC::class, 'criarExercicioA']);
Route::post('/series/salvar',[SeriesControllerC::class, 'salvarExercicioA']);
// entre chaves para informar que vou passar um id para o método "edit" através da url == /series/editar/{idDaSerie}
Route::get('/series/editar/{id}', [SeriesControllerC::class, 'editarExercicioA']);
// verbo http put para dizer que vou atualizar um registro
Route::put('/series/atualizar/{id}', [SeriesControllerC::class, 'atualizarExercicioA']);
Route::delete('/series/deletar/{id}', [SeriesControllerC::class, 'destruirExercicioA']);
