<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pessoas', [PersonController::class, 'index'])->name('people.index');
Route::get('/pessoas/criar', [PersonController::class, 'create'])->name('people.create');
Route::get('/pessoas/{id}', [PersonController::class, 'show'])->name('people.show');
Route::get('/pessoas/{id}/editar', [PersonController::class, 'edit'])->name('people.edit');
Route::post('/pessoas', [PersonController::class, 'store'])->name('people.store');
Route::put('/pessoas/{id}', [PersonController::class, 'update'])->name('people.update');
Route::delete('/pessoas/{id}', [PersonController::class, 'destroy'])->name('people.destroy');
