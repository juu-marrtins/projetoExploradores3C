<?php

use App\Http\Controllers\ExplorerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::put('/explorers/{id}', [ExplorerController::class, 'update'])->name('explorer.update');
Route::post('/explorers', [ExplorerController::class, 'store'])->name('explorer.store');
Route::get('/home', [ExplorerController::class, 'index'])->name('explorer.index');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
