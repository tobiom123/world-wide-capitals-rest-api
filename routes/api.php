<?php

use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/countries', [\App\Http\Controllers\CountryController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/countries-only', [\App\Http\Controllers\CountryController::class, 'getCountriesArray']);
Route::middleware(['auth:sanctum'])->get('/random-country', [\App\Http\Controllers\CountryController::class, 'getRandomCountry']);
