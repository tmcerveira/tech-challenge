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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'genres' => GenreController::class,
]);

Route::resources([
    'movies' => MovieController::class,
]);

Route::resources([
    'actors' => ActorController::class,
]);


Route::get('/actor/appearances/{name}', 'ActorController@appearances')->name('actor.appearances');

Route::get('/actor/genre/{name}', 'ActorController@favoriteGenre')->name('actor.genre');




