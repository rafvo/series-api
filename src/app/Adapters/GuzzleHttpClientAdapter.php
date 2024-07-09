<?php

namespace App\Adapters;

use GuzzleHttp\Client;
use App\Interfaces;

class GuzzleHttpClientAdapter implements Interfaces\HttpClientInterface
{
  public function __construct(private Client $client)
  {
  }

  public function request(string $method, string $url, ?array $options = []): object
  {
    return $this->client->request(method: $method, uri: $url, options: $options);
  }
}
