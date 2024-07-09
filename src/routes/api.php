<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// public routes
Route::post('/login', [Controllers\AuthController::class, 'login']);
Route::post('/users/register', [Controllers\UsersController::class, 'register']);

// private routes
Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  Route::get('/auth-check', function () {
    return response()->json(['message' => 'Você está autenticado']);
  });

  Route::get('/users', [Controllers\UsersController::class, 'index']);

  // series
  Route::get('/series', [Controllers\SeriesController::class, 'getAll']);
  Route::get('/series/seasons', [Controllers\SeriesController::class, 'showSeriesSeasons']);
  Route::get('/series/seasons/episodes', [Controllers\SeriesController::class, 'showSeriesSeasonsEpisodes']);
  Route::get('/series/{id}', [Controllers\SeriesController::class, 'show']);
  Route::get('/series/{id}/serie-seasons', [Controllers\SeriesController::class, 'showSerieSeasons']);
  Route::get('/series/{id}/serie-seasons/episodes', [Controllers\SeriesController::class, 'showSerieSeasonsEpisodes']);
  Route::get('/series/{id}/seasons', [Controllers\SeriesController::class, 'showSeasonsBySerie']);
  Route::get('/series/{id}/episodes', [Controllers\SeriesController::class, 'showEpisodesBySerie']);
  Route::get('/series/{id}/seasons/episodes', [Controllers\SeriesController::class, 'showSeasonsEpisodesBySerie']);
  Route::delete('/series/{id}', [Controllers\SeriesController::class, 'destroy']);
  Route::put('/series/{id}', [Controllers\SeriesController::class, 'update']);
  Route::post('/series', [Controllers\SeriesController::class, 'store']);

  // seasons
  Route::post('/seasons', [Controllers\SeasonsController::class, 'store']);
  Route::delete('/seasons/{id}', [Controllers\SeasonsController::class, 'destroy']);
  Route::put('/seasons/{id}', [Controllers\SeasonsController::class, 'update']);

  // episodes
  Route::post('/episodes', [Controllers\EpisodesController::class, 'store']);
  Route::delete('/episodes/{id}', [Controllers\EpisodesController::class, 'destroy']);
  Route::put('/episodes/{id}', [Controllers\EpisodesController::class, 'update']);
  Route::patch('/episodes/{id}', [Controllers\EpisodesController::class, 'update']);
  Route::patch('/episodes/{id}/watched', [Controllers\EpisodesController::class, 'watched']);
  Route::patch('/episodes/{id}/unwatched', [Controllers\EpisodesController::class, 'unwatched']);

  // address
  Route::get('/address/cep', [Controllers\AddressController::class, 'getAddressByCEP']);
});




























// Route::middleware([JWTMiddleware::class])->group(function () {
//     Route::get('/auth-check', function () {
//         return response()->json(['message' => 'Você está autenticado']);
//     });

//     Route::get('/logged-user', [Controllers\UsersController::class, 'getLoggedUser']);
// });