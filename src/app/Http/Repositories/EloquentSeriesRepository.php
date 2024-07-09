<?php

namespace App\Http\Repositories;

use App\Traits;
use App\Models;
use App\DTOs;
use App\Http\Resources;
use App\Interfaces;

class EloquentSeriesRepository implements Interfaces\SeriesRepository
{
  use Traits\Pagination;
  // use Traits\QueryCache;

  public function __construct(
    private Models\Serie $serie,
  ) {
  }

  public function getAll(DTOs\SerieFilterDTO $filter)
  {
    $query = $this->serie::query();

    if (isset($filter->pagination->search)) {
      $query->where('name', 'LIKE', "%{$filter->pagination->search}%");
    }

    $paginatedQuery = $this->pagination(
      paginationDTO: $filter->pagination,
      query: $query,
    );

    // $series = $this->queryCache($request, $paginatedQuery);

    return Resources\SeriesResource::collection($paginatedQuery);
  }

  public function store(DTOs\SerieDTO $serie)
  {
    return $this->serie::create(attributes: $serie->toArray());
  }

  public function findOrFailId(int $serieId)
  {
    return $this->serie::findOrFail(id: $serieId);
  }

  public function showSeriesSeasons()
  {
    return $this->serie::with('seasons')->get();
  }

  public function showSeriesSeasonsEpisodes()
  {
    return $this->serie::with('seasons.episodes')->get();
  }

  public function showSerieSeasons(int $serieId)
  {
    return $this->serie::with('seasons')->findOrFail($serieId);
  }

  public function showSerieSeasonsEpisodes(int $serieId)
  {
    return $this->serie::with('seasons.episodes')->findOrFail($serieId);
  }

  public function showSeasonsBySerie(int $serieId)
  {
    return $this->serie::with('seasons')->findOrFail($serieId)->seasons;
  }

  public function showEpisodesBySerie(int $serieId)
  {
    return $this->serie->findOrFail($serieId)->episodes;
  }

  public function showSeasonsEpisodesBySerie(int $serieId)
  {
    return $this->serie::with('seasons.episodes')->findOrFail($serieId)->seasons;
  }

  public function update(int $serieId, DTOs\SerieDTO $serie)
  {
    $model = $this->findOrFailId(serieId: $serieId);
    $model->update(attributes: $serie->toArray());

    return $model;
  }

  public function destroy(int $serieId)
  {
    $model = $this->findOrFailId($serieId);
    $model->delete();

    return $model;
  }
}
