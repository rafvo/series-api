<?php

namespace App\DTOs;

class SerieFilterDTO
{
  public function __construct(
    public ?string $date = '',
    public ?PaginationDTO $pagination = null,
  ) {}

  /**
   *
   * @param object $attrs
   * @return self
   */
  public static function fill(object $attrs)
  {
    return new self(
      date: $attrs?->date ?? '',
      pagination: PaginationDTO::fill($attrs?->pagination),
    );
  }
}
