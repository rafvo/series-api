<?php

use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models;
use App\Http\Resources\SeriesCreatedMailResource;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/mail/series/{id}/created', function (int $id) {
	$serie = Models\Serie::findOrFail($id);
	$resource = new SeriesCreatedMailResource($serie);

	return new Mail\SeriesCreated($resource);
});
