<?php

namespace App\DTOs;

class EpisodeDTO
{
  public function __construct(
    public ?int $id = null,
    public ?int $season_id = null,
    public string $name = '',
    public ?int $number = null,
    public bool $watched = false,
  ) {
  }

  /**
   *
   * @param object $attrs
   * @return self
   */
  public static function fill(object $attrs)
  {
    return new self(
      id: $attrs?->id ?? null,
      season_id: $attrs?->season_id ?? null,
      name: $attrs?->name,
      number: $attrs?->number,
      watched: $attrs->watched == "true"
    );
  }

  /**
   *
   * @return array
   */
  public function toArray()
  {
    return [
      'id' => $this->id,
      'season_id' => $this->season_id,
      'name' => $this->name,
      'number' => $this->number,
      'watched' => $this->watched,
    ];
  }
}
