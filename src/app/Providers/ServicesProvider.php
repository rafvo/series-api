<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces;
use App\Http\Services;

class ServicesProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bind(
      Interfaces\SeriesService::class,
      Services\EloquentSeriesService::class
    );

    $this->app->bind(
      Interfaces\SeasonsService::class,
      Services\EloquentSeasonsService::class
    );

    $this->app->bind(
      Interfaces\EpisodesService::class,
      Services\EloquentEpisodesService::class
    );

    $this->app->bind(
      Interfaces\CepFinderService::class,
      Services\ViaCepService::class
    );

    $this->app->bind(
      Interfaces\CitiesService::class,
      Services\EloquentCitiesService::class
    );

    $this->app->bind(
      Interfaces\StatesService::class,
      Services\EloquentStatesService::class
    );
  }
}
