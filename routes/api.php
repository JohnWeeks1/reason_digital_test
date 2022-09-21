<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

// Route::get('forecast/{location?}', [\App\Http\Controllers\API\WeatherController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('forecast/{location?}', [\App\Http\Controllers\API\WeatherController::class, 'index']);
});
