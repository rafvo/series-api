<?php

namespace App\Http\Services;

use App\Interfaces;
use App\DTOs;

class EloquentSeasonsService implements Interfaces\SeasonsService
{
  public function __construct(
    private Interfaces\SeasonsRepository $seasonRepository,
    private Interfaces\EpisodesService $episodeService,
  ) {
  }

  public function store(DTOs\SeasonDTO $season)
  {
    return $this->seasonRepository->store(season: $season);
  }

  public function arrayStore(int $serieId, array $seasons)
  {
    foreach ($seasons as $season) {
      $season->serie_id = $serieId;
      $insertedSeason = $this->seasonRepository->store(season: $season);

      if (!empty($season?->episodes)) {
        $this->episodeService->arrayStore(seasonId: $insertedSeason->id, episodes: $season->episodes);
      }
    }
  }

  public function update(int $seasonId, DTOs\SeasonDTO $season)
  {
    return $this->seasonRepository->update(seasonId: $seasonId, season: $season);
  }

  public function deleteNotUpdatedSeasons(int $serieId, array $seasonIds)
  {
    if (!empty($seasonIds)) {
      $this->seasonRepository->deleteNotInIds(seasonIds: $seasonIds);
    } else {
      $this->seasonRepository->deleteBySerieId(serieId: $serieId);
    }
  }

  public function updateOrCreateSeasons(int $serieId, array $seasons)
  {
    foreach ($seasons as $season) {
      $season->serie_id = $serieId;
      $updatedOrCreatedSeason = $this->seasonRepository->updateOrCreate(season: $season);

      $this->episodeService->arrayUpdate(seasonId: $updatedOrCreatedSeason->id, episodes: $season->episodes);
    }
  }

  public function arrayUpdate(int $serieId, array $seasons)
  {
    $seasonIds = collect($seasons)?->pluck('id')?->filter()?->all() ?? [];

    $this->deleteNotUpdatedSeasons(serieId: $serieId, seasonIds: $seasonIds);
    $this->updateOrCreateSeasons(serieId: $serieId, seasons: $seasons);
  }

  public function destroy(int $seasonId)
  {
    return $this->seasonRepository->destroy(seasonId: $seasonId);
  }
}
