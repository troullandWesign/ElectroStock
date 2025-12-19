<?php

use App\Http\Controllers\Api\ComponentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Routes RESTful pour la gestion des composants
Route::apiResource('components', ComponentController::class);

// Routes supplémentaires pour filtrer par type
Route::get('components/type/{type}', [ComponentController::class, 'byType'])
    ->name('components.byType')
    ->where('type', 'resistor|capacitor|microcontroller');

// Routes pour la gestion du stock
Route::get('components/stock/low', [ComponentController::class, 'lowStock'])
    ->name('components.lowStock');

Route::get('components/stock/out', [ComponentController::class, 'outOfStock'])
    ->name('components.outOfStock');
