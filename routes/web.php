<?php

use App\Http\Controllers\ExplorerController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [ExplorerController::class, 'index'])->name('explorer.index');
Route::get('/', function () {
    return view('welcome');
});
