<?php

namespace App\Http\Repositories;

use App\Models;
use App\Interfaces;

class EloquentStatesRepository implements Interfaces\StatesRepository
{
  public function __construct(
    private Models\State $state,
  ) {
  }

  public function getById(int $id): Models\State
  {
    return $this->state::where('id', $id)->first();
  }
}
