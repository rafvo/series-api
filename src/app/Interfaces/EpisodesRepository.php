<?php

namespace App\Interfaces;

use App\Models;
use App\DTOs;
use Illuminate\Support\Collection;

interface EpisodesRepository {
  /**
   *
   * @param DTOs\EpisodeDTO $episode
   * @return Models\Episode
   */
  public function store(DTOs\EpisodeDTO $episode);

  /**
   *
   * @param Collection $episodes
   * @return bool
   */
  public function insert(Collection $episodes);

  /**
   *
   * @param int $episodeId
   * @return Models\Episode
   */
  public function findOrFailId(int $episodeId);

  /**
   * @param int $episodeId
   * @param DTOs\EpisodeDTO $episode
   * @return Models\Episode
   */
  public function update(int $episodeId, DTOs\EpisodeDTO $episode);

  /**
   * @param DTOs\EpisodeDTO $episode
   * @return Models\Episode
   */
  public function updateOrCreate(DTOs\EpisodeDTO $episode);

  /**
   * @param int $episodeId
   * @return Models\Episode
   */
  public function watched(int $episodeId);

  /**
   * @param int $episodeId
   * @return Models\Episode
   */
  public function unwatched(int $episodeId);

  /**
   * @param int $episodeId
   * @return int
   */
  public function destroy(int $episodeId);

  /**
   * @param int $seasonId
   * @param int[] $episodeIds
   * @return bool|null
   */
  public function deleteNotInIds(int $seasonId, array $episodeIds);

  /**
   * @param int $serieId
   * @return bool|null
   */
  public function deleteBySeasonId(int $seasonId);
}
