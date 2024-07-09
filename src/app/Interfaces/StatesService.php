<?php

namespace App\Interfaces;

use App\Models;

interface StatesService {
  /**
   *
   * @param int $id
   * @return Models\State
   */
  public function getById(int $id);
}