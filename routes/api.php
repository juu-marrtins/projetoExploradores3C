<?php

use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/item', [ItemController::class, 'store']);

Route::put('/explorers/{id}', [ExplorerController::class, 'update']);

Route::post('/explorers', [ExplorerController::class, 'store']);

Route::get('/home', [ExplorerController::class, 'index']); //listagem 
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
