<?php

namespace App\Http\Repositories;

use App\Models;
use App\Interfaces;

class EloquentCitiesRepository implements Interfaces\CitiesRepository
{
  public function __construct(
    private Models\City $city,
  ) {
  }

  public function getByIbgeCode(string $ibgeCode): Models\City
  {
    return $this->city::where('ibge_code', $ibgeCode)->first();
  }
}
