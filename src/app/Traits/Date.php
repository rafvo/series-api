<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Date
{
  protected function localeDateSearch($search) {
    try {
      return \Carbon\Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d');
    } catch (\Throwable $th) {
      return $search;
    }
  }
}
