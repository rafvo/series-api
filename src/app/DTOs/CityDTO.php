<?php

namespace App\DTOs;

class CityDTO
{
  public function __construct(
    public ?int $id = null,
    public string $name = '',
    public ?int $state_id = null,
    public ?string $ibge_code = '',
  ) {
  }

  /**
   *
   * @param object $attrs
   * @return self
   */
  public static function fill(object $attrs) {
    return new self(
      id: $attrs?->id ?? null,
      name: $attrs?->name ?? '',
      state_id: $attrs?->state_id,
      ibge_code: $attrs?->ibge_code,
    );
  }
}
