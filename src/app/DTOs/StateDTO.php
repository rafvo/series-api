<?php

namespace App\DTOs;

class StateDTO
{
  public function __construct(
    public ?int $id = null,
    public string $name = '',
    public ?string $abbreviation = '',
  ) {}

  /**
   *
   * @param object $attrs
   * @return self
   */
  public static function fill(object $attrs) {
    return new self(
      id: $attrs->id,
      name: $attrs->name,
      abbreviation: $attrs->abbreviation,
    );
  }
}
