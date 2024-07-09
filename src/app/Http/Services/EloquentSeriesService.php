<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use App\Events;
use App\Jobs;
use App\Models;
use App\Interfaces;
use App\DTOs;

class EloquentSeriesService implements Interfaces\SeriesService
{
  public function __construct(
    private Interfaces\SeriesRepository $serieRepository,
    private Interfaces\SeasonsService $seasonService,
  ) {
  }

  public function store(DTOs\SerieDTO $serie): Models\Serie
  {
    return DB::transaction(function () use ($serie) {
      $insertedSerie = $this->serieRepository->store(serie: $serie);

      if (!empty($serie->seasons)) {
        $this->seasonService->arrayStore(serieId: $insertedSerie->id, seasons: $serie->seasons);
      }

      Events\SeriesCreated::dispatch($insertedSerie);

      return $this->serieRepository->showSerieSeasonsEpisodes($insertedSerie->id);
    });
  }

  public function update(int $serieId, DTOs\SerieDTO $serie): Models\Serie
  {
    return DB::transaction(function () use ($serieId, $serie) {
      $this->serieRepository->update(serieId: $serieId, serie: $serie);
      $this->seasonService->arrayUpdate(serieId: $serieId, seasons: $serie->seasons);
      
      return $this->serieRepository->showSerieSeasonsEpisodes($serieId);
    });
  }

  public function destroy(int $serieId): void
  {
    $serie = $this->serieRepository->destroy(serieId: $serieId);

    Jobs\DeleteSerieAttachment::dispatch($serie->attachment);
  }
}
