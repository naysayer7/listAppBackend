<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
    // Main page
    Route::get('/', [ItemsController::class, 'index']);

    // User profile page
    Route::get('/profile', function (Request $request) {
        return view('profile', ['user' => $request->user()]);
    });

    // Update avatar
    Route::post('/profile/avatar', [UserController::class, 'storeAvatar']);

    // Add bot token
    Route::post('/profile/addtgtoken', [UserController::class, 'addTelegramToken']);

    // Remove bot token
    Route::get('/profile/revoketgtoken', [UserController::class, 'revokeTelegramToken']);
    Route::get('/profile/tokens', function (Request $request) {
        dd($request->user()->tokens()->where('name', 'tg-token')->get()->isNotEmpty());
    });
});
