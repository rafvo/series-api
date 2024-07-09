<?php

namespace App\Interfaces;

interface HttpClientInterface
{
  /**
   *
   * @param string $method
   * @param string $url
   * @param array $options
   * @return object
   */
  public function request(string $method, string $url, ?array $options = []): object;
}
