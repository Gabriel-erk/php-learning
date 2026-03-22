<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', [SeriesController::class, 'index']);
Route::get('/series/criar', [SeriesController::class, 'create']);
Route::post('/series/salvar',[SeriesController::class, 'store']);
// entre chaves para informar que vou passar um id para o método "edit" através da url == /series/editar/{idDaSerie}
Route::get('/series/editar/{id}', [SeriesController::class, 'edit']);
// verbo http put para dizer que vou atualizar um registro
Route::put('/series/atualizar/{id}', [SeriesController::class, 'update']);
Route::delete('/series/deletar/{id}', [SeriesController::class, 'destroy']);
