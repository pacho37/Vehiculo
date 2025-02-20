<?php

use App\Http\Controllers\CarroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarroController::class, 'index'])->name('carros.index');
Route::resource('carros', CarroController::class);
Route::get('carros/{carro}/edit', [CarroController::class, 'edit'])->name('carros.edit');
Route::put('carros/{carro}', [CarroController::class, 'update'])->name('carros.update');
