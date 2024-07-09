<?php

namespace App\Http\Services;

use App\Models;
use App\Interfaces;

class EloquentStatesService implements Interfaces\StatesService
{
  public function __construct(
    private Interfaces\StatesRepository $statesRepository,
  ) {
  }

  public function getById(int $id): Models\State
  {
    return $this->statesRepository->getById(id: $id);
  }
}
