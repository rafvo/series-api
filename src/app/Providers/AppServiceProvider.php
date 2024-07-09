<?php

namespace App\Providers;

use App\Events;
use App\Listeners;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
  protected $listen = [
    Events\SeriesCreated::class => [
      Listeners\LogSeriesCreated::class,
      Listeners\EmailUsersAboutSeriesCreated::class
    ]
  ];

  /**
   * Register any application services.
   */
  public function register(): void
  {
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    JsonResource::withoutWrapping();
  }
}
