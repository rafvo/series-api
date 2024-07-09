<?php

namespace App\Http\Services;

use App\Models;
use App\Interfaces;

class EloquentCitiesService implements Interfaces\CitiesService
{
  public function __construct(
    private Interfaces\CitiesRepository $citiesRepository,
  ) {
  }

  public function getByIbgeCode(string $ibgeCode): Models\City
  {
    return $this->citiesRepository->getByIbgeCode(ibgeCode: $ibgeCode);
  }
}
