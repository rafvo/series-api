<?php

namespace App\Http\Services;

use App\Interfaces;
use App\DTOs;

class EloquentEpisodesService implements Interfaces\EpisodesService
{
  public function __construct(
    private Interfaces\EpisodesRepository $episodeRepository,
  ) {
  }

  public function store(DTOs\EpisodeDTO $episode)
  {
    return $this->episodeRepository->store(episode: $episode);
  }

  public function arrayStore(int $seasonId, array $episodes) {
    $episodes = collect($episodes)->map(function ($episode) use ($seasonId) {
      $episode->season_id = $seasonId;

      return (array)$episode;
    });

    return $this->episodeRepository->insert(episodes: $episodes);
  }

  public function update(int $episodeId, DTOs\EpisodeDTO $episode)
  {
    return $this->episodeRepository->update(episodeId: $episodeId, episode: $episode);
  }

  public function deleteNotUpdatedEpisodes(int $seasonId, array $episodeIds)
  {
    if (!empty($episodeIds)) {
      $this->episodeRepository->deleteNotInIds(seasonId: $seasonId, episodeIds: $episodeIds);
    } else {
      $this->episodeRepository->deleteBySeasonId(seasonId: $seasonId);
    }
  }

  public function updateOrCreateEpisodes(int $seasonId, array $episodes)
  {
    foreach ($episodes as $episode) {
      $episode->season_id = $seasonId;
      $episode = $this->episodeRepository->updateOrCreate(episode: $episode);
    }
  }

  public function arrayUpdate(int $seasonId, array $episodes)
  {
    $episodeIds = collect($episodes)?->pluck('id')?->filter()?->all() ?? [];

    $this->deleteNotUpdatedEpisodes(seasonId: $seasonId, episodeIds: $episodeIds);
    $this->updateOrCreateEpisodes(seasonId: $seasonId, episodes: $episodes);
  }

  public function watched(int $episodeId)
  {
    return $this->episodeRepository->watched(episodeId: $episodeId);
  }

  public function unwatched(int $episodeId)
  {
    return $this->episodeRepository->unwatched(episodeId: $episodeId);
  }

  public function destroy(int $episodeId)
  {
    return $this->episodeRepository->destroy(episodeId: $episodeId);
  }
}
