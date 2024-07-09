<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\DTOs;

trait Pagination
{
  protected function pagination(DTOs\PaginationDTO $paginationDTO, Builder $query)
  {
    $limit = min($paginationDTO->limit, 100);
    $offset = $paginationDTO->offset;

    return $query->offset($offset)->limit($limit)->paginate($limit);
  }
}
