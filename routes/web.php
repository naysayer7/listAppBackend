<?php

use App\Http\Controllers\ItemsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main page
Route::get('/', [ItemsController::class, 'index']);

// Add an item
Route::post('/add', [ItemsController::class, 'store']);

// Edit an item
Route::post('/edit', [ItemsController::class, 'update']);

// Remove an item
Route::post('/remove', [ItemsController::class, 'remove']);
