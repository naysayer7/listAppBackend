<?php

use App\Http\Controllers\ItemsController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Show items
    Route::get('/items', [ItemsController::class, 'show']);

    // Add an item
    Route::post('/items/add', [ItemsController::class, 'store']);

    // Edit an item
    Route::post('/items/edit', [ItemsController::class, 'update']);

    // Remove an item
    Route::post('/items/remove', [ItemsController::class, 'destroy']);
});
