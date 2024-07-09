<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\DTOs;
use Illuminate\Support\Facades\Log;
use App\Interfaces;

class SeriesController extends Controller
{
  public function __construct(
    private Interfaces\SeriesService $serieService,
    private Interfaces\SeriesRepository $serieRepository,
  ) {
  }

  public function getAll(Requests\PaginationRequest $request, DTOs\SerieFilterDTO $serieFilter)
  {
    $serieFilter = $serieFilter::fill((object)$request->all());
    $series = $this->serieRepository->getAll(filter: $serieFilter);

    return response()->json(data: $series, status: 200);
  }

  public function store(Requests\SeriesStoreRequest $request, DTOs\SerieDTO $serie)
  {
    $attrs = (object)$request->all();
    $serie = $serie::fill(attrs: $attrs);
    $serie = $this->serieService->store(serie: $serie);

    return response()->json(data: $serie, status: 201);
  }

  public function show(int $serieId)
  {
    $serie = $this->serieRepository->findOrFailId(serieId: $serieId);

    return response()->json(data: $serie, status: 200);
  }

  public function showSeriesSeasons()
  {
    $series = $this->serieRepository->showSeriesSeasons();

    return response()->json(data: $series, status: 200);
  }

  public function showSeriesSeasonsEpisodes()
  {
    $series = $this->serieRepository->showSeriesSeasonsEpisodes();

    return response()->json(data: $series, status: 200);
  }

  public function showSerieSeasons(int $serieId)
  {
    $serie = $this->serieRepository->showSerieSeasons(serieId: $serieId);

    return response()->json(data: $serie, status: 200);
  }

  public function showSerieSeasonsEpisodes(int $serieId)
  {
    $serie = $this->serieRepository->showSerieSeasonsEpisodes(serieId: $serieId);

    return response()->json(data: $serie, status: 200);
  }

  public function showSeasonsBySerie(int $serieId)
  {
    $seasons = $this->serieRepository->showSeasonsBySerie(serieId: $serieId);

    return response()->json(data: $seasons, status: 200);
  }

  public function showEpisodesBySerie(int $serieId)
  {
    $episodes = $this->serieRepository->showEpisodesBySerie(serieId: $serieId);

    return response()->json(data: $episodes, status: 200);
  }

  public function showSeasonsEpisodesBySerie(int $serieId)
  {
    $seasons = $this->serieRepository->showSeasonsEpisodesBySerie(serieId: $serieId);

    return response()->json(data: $seasons, status: 200);
  }

  public function update(Requests\SeriesUpdateRequest $request, int $serieId, DTOs\SerieDTO $serie)
  {
    try {
      $serie = $serie::fill(attrs: (object)$request->all());
      $serie = $this->serieService->update(serieId: $serieId, serie: $serie);

      return response()->json(
        data: [
          'message' => 'Série atualizada com sucesso!',
          'serie' => $serie,
        ],
        status: 200
      );
    } catch (\Illuminate\Validation\ValidationException $e) {
      // Log validation errors
      Log::error('Validation Errors: ', $e->errors());
      return response()->json(['errors' => $e->errors()], 422);
    }
  }

  public function destroy(int $serieId)
  {
    $this->serieService->destroy(serieId: $serieId);

    return response()->json(
      data: [
        'message' => 'Série removida com sucesso!',
      ],
      status: 200
    );
  }
}
