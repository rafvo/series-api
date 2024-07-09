<?php

namespace App\DTOs;

class SeasonDTO
{
  /**
   *
   * @param ?int $id
   * @param ?int $serie_id
   * @param string $name
   * @param ?int $number
   * @param EpisodeDTO[] $episodes
   */
  public function __construct(
    public ?int $id = null,
    public ?int $serie_id = null,
    public string $name = '',
    public ?int $number = null,
    public array $episodes = []
  ) {}

  /**
   *
   * @param array $episodes
   * @return EpisodeDTO[]
   */
  private static function episodes(array $episodes = [])
  {
    if (empty($episodes)) {
      return [];
    }

    return array_map(function ($episode) {
      $episode = (object)$episode;

      return EpisodeDTO::fill($episode);
    }, $episodes);
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
      serie_id: $attrs->serie_id ?? null,
      name: $attrs?->name,
      number: $attrs?->number,
      episodes: self::episodes($attrs->episodes),
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
      'serie_id' => $this->serie_id,
      'name' => $this->name,
      'number' => $this->number,
      'episodes' => $this->episodes,
    ];
  }
}
