<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App;
use App\Models;
use App\Http\Resources;
use Illuminate\Support\Facades\Mail;
use App\Events\SeriesCreated;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
  /**
   * Create the event listener.
   */
  public function __construct()
  {
  }

  /**
   * Handle the event.
   */
  public function handle(SeriesCreated $event): void
  {
    $resource = new Resources\SeriesCreatedMailResource($event->serie);
    $users = Models\User::all();

    foreach ($users as $index => $user) {
      $email = new App\Mail\SeriesCreated($resource);
      $when = now()->addSeconds($index * 5);

      Mail::to($user)->later($when, $email);
    }
  }
}
