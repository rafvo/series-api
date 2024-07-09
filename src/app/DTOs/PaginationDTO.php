<?php

namespace App\DTOs;

class PaginationDTO
{
  public function __construct(
    public ?int $offset = null,
    public ?int $limit = null,
    public ?string $search = ''
  ) {}

  /**
   *
   * @param object $attrs
   * @return self
   */
  public static function fill(?object $attrs)
  {
    return new self(
      offset: $attrs?->offset ?? 1,
      limit: $attrs?->limit ?? 10,
      search: $attrs?->search,
    );
  }
}
