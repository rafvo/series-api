<?php

namespace App\Interfaces;

use App\Models;

interface CitiesRepository {
  /**
   *
   * @param string $ibgeCode
   * @return Models\City
   */
  public function getByIbgeCode(string $ibgeCode);
}