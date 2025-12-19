<?php

use App\Http\Controllers\ComponentWebController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Routes pour les composants (front-end)
Route::get('/components', [ComponentWebController::class, 'index'])->name('components.index');
Route::get('/components/create', [ComponentWebController::class, 'create'])->name('components.create');
Route::post('/components', [ComponentWebController::class, 'store'])->name('components.store');
Route::get('/components/{component}/edit', [ComponentWebController::class, 'edit'])->name('components.edit');
Route::put('/components/{component}', [ComponentWebController::class, 'update'])->name('components.update');
Route::delete('/components/{component}', [ComponentWebController::class, 'destroy'])->name('components.destroy');
