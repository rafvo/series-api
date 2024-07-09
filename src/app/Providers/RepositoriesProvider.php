<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces;
use App\Http\Repositories;

class RepositoriesProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bind(
      Interfaces\SeriesRepository::class,
      Repositories\EloquentSeriesRepository::class
    );

    $this->app->bind(
      Interfaces\SeasonsRepository::class,
      Repositories\EloquentSeasonsRepository::class
    );

    $this->app->bind(
      Interfaces\EpisodesRepository::class,
      Repositories\EloquentEpisodesRepository::class
    );

    $this->app->bind(
      Interfaces\CitiesRepository::class,
      Repositories\EloquentCitiesRepository::class
    );

    $this->app->bind(
      Interfaces\StatesRepository::class,
      Repositories\EloquentStatesRepository::class
    );
  }
}
