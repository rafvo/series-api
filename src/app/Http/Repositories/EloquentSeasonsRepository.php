<?php

namespace App\Http\Repositories;

use App\Models;
use App\DTOs;
use App\Interfaces;

class EloquentSeasonsRepository implements Interfaces\SeasonsRepository
{
  public function __construct(
    private Models\Season $season,
  ) {
  }

  public function store(DTOs\SeasonDTO $season)
  {
    return $this->season::create(attributes: $season->toArray());
  }

  public function findOrFailId(int $seasonId)
  {
    return $this->season::findOrFail(id: $seasonId);
  }

  public function update(int $seasonId, DTOs\SeasonDTO $season)
  {
    $model = $this->findOrFailId(seasonId: $seasonId);
    $model->update(attributes: $season->toArray());

    return $model;
  }

  public function updateOrCreate(DTOs\SeasonDTO $season)
  {
    return $this->season::updateOrCreate(
      attributes: [
        'id' => $season?->id,
      ],
      values: $season->toArray(),
    );
  }

  public function destroy(int $seasonId)
  {
    $model = $this->findOrFailId(seasonId: $seasonId);
    $model->delete();

    return $model;
  }

  public function deleteNotInIds($seasonIds)
  {
    return $this->season::whereNotIn('id', $seasonIds)->delete();
  }

  public function deleteBySerieId(int $serieId)
  {
    return $this->season::where('serie_id', $serieId)->delete();
  }
}
