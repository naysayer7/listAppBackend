<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UserController;
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
Route::middleware('auth:sanctum')->get('/', [ItemsController::class, 'index']);



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'register']);

Route::get('/logout', [UserController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Add an item
    Route::post('/items/add', [ItemsController::class, 'store']);

    // Edit an item
    Route::post('/items/edit', [ItemsController::class, 'update']);

    // Remove an item
    Route::post('/items/remove', [ItemsController::class, 'destroy']);
});