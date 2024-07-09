<?php

namespace App\Interfaces;

use App\Models;
use App\DTOs;

interface EpisodesService {
  /**
   *
   * @param DTOs\EpisodeDTO $episode
   * @return Models\Episode
   */
  public function store(DTOs\EpisodeDTO $episode);

  /**
   *
   * @param int $seasonId
   * @param DTOs\EpisodeDTO[] $episodes
   * @return bool
   */
  public function arrayStore(int $seasonId, array $episodes);

  /**
   *
   * @param int $episodeId
   * @param DTOs\EpisodeDTO $episode
   * @return Models\Episode
   */
  public function update(int $episodeId, DTOs\EpisodeDTO $episode);

  /**
   *
   * @param int $seasonId
   * @param int[] $episodeIds
   * @return void
   */
  public function deleteNotUpdatedEpisodes(int $seasonId, array $episodeIds);

  /**
   *
   * @param int $seasonId
   * @param DTOs\EpisodeDTO[] $episodes
   * @return void
   */
  public function updateOrCreateEpisodes(int $seasonId, array $episodes);

  /**
   *
   * @param int $seasonId
   * @param DTOs\EpisodeDTO[] $episodes
   * @return void
   */
  public function arrayUpdate(int $seasonId, array $episodes);

  /**
   *
   * @param int $episodeId
   * @return Models\Episode
   */
  public function watched(int $episodeId);

  /**
   *
   * @param int $episodeId
   * @return Models\Episode
   */
  public function unwatched(int $episodeId);

  /**
   *
   * @param int $episodeId
   * @return int
   */
  public function destroy(int $episodeId);
}
