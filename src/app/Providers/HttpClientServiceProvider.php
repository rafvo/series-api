<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces;
use App\Adapters;

class HttpClientServiceProvider extends ServiceProvider
{
  public function register(): void
  {
    $this->app->bind(
      Interfaces\HttpClientInterface::class,
      Adapters\GuzzleHttpClientAdapter::class
    );
  }
}
