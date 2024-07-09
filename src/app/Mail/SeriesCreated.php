<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources;

class SeriesCreated extends Mailable
{
  use Queueable, SerializesModels;

  public $serieResource;

  public function __construct(Resources\SeriesCreatedMailResource $serieResource)
  {
    $this->serieResource = json_decode($serieResource->toJson());
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->markdown('mail.series.created')
      ->with([
        'serieResource' => $this->serieResource,
      ]);
  }
}
