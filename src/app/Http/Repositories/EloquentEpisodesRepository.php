<?php

namespace App\Http\Repositories;

use App\Models;
use App\DTOs;
use App\Interfaces;
use Illuminate\Support\Collection;

class EloquentEpisodesRepository implements Interfaces\EpisodesRepository
{
  public function __construct(
    private Models\Episode $episode,
  ) {}

  public function store(DTOs\EpisodeDTO $episode)
  {
    return $this->episode::create(attributes: $episode->toArray());
  }

  public function insert(Collection $episodes)
  {
    return $this->episode::insert($episodes->all());
  }

  public function findOrFailId(int $episodeId)
  {
    return $this->episode::findOrFail(id: $episodeId);
  }

  public function update(int $episodeId, DTOs\EpisodeDTO $episode)
  {
    $model = $this->findOrFailId(episodeId: $episodeId);
    $model->update(attributes: $episode->toArray());

    return $model;
  }

  public function updateOrCreate(DTOs\EpisodeDTO $episode) {
    return $this->episode::updateOrCreate(
      attributes: [
        'id' => $episode?->id,
      ],
      values: $episode->toArray(),
    );
  }

  public function watched(int $episodeId)
  {
    $model = $this->findOrFailId(episodeId: $episodeId);
    $model->watched = true;
    $model->save();

    return $model;
  }

  public function unwatched(int $episodeId)
  {
    $model = $this->findOrFailId(episodeId: $episodeId);
    $model->watched = false;
    $model->save();

    return $model;
  }

  public function destroy(int $episodeId)
  {
    $model = $this->findOrFailId(episodeId: $episodeId);

    return $model::destroy($episodeId);
  }

  public function deleteNotInIds(int $seasonId, array $episodeIds) {
    return $this->episode::whereNotIn('id', $episodeIds)
                        ->where('id', $seasonId)->delete();
  }

  public function deleteBySeasonId(int $seasonId) {
    return $this->episode::where('season_id', $seasonId)->delete();
  }
}
