<?php

namespace App\DTOs;

class SerieDTO
{
  /**
   *
   * @param ?int $id
   * @param string $name
   * @param ?string $attachment
   * @param SeasonDTO[] $seasons
   */
  public function __construct(
    public ?int $id = null,
    public string $name = '',
    public ?string $attachment = '',
    public array $seasons = [],
  ) {}

  /**
   *
   * @param array $seasons
   * @return SeasonDTO[]
   */
  private static function seasons(array $seasons = [])
  {
    if (empty($seasons)) {
      return [];
    }

    return array_map(function ($season) {
      $season = (object)$season;

      return SeasonDTO::fill($season);
    }, $seasons);
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
      name: $attrs?->name,
      attachment: $attrs?->attachment ?? '',
      seasons: self::seasons($attrs->seasons),
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
      'name' => $this->name,
      'attachment' => $this->attachment,
      'seasons' => $this->seasons,
    ];
  }
}
