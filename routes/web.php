<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContatoController::class, 'index']);
Route::post('/save', [ContatoController::class, 'form']);
Route::delete('/delete/{id}', [ContatoController::class, 'delete'])->name('contatos.delete');
Route::get('/edit/{id}', [ContatoController::class, 'edit']);
Route::put('/update/{id}', [ContatoController::class, 'update']);

Route::get('/sobre', function () {
    return 'Minha primeira aplicação Laravel está no ar!';
});
