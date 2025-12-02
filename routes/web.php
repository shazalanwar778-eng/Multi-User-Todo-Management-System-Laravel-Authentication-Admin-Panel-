<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index']);
Route::get('create', [TodoController::class, 'create']);

Route::get('details/{todo}', [TodoController::class, 'details']);
Route::get('edit/{todo}', [TodoController::class, 'edit']);
Route::post('update/{todo}', [TodoController::class, 'update']);

Route::get('delete/{todo}', [TodoController::class, 'delete']);
Route::post('store', [TodoController::class, 'store'])->name('store');