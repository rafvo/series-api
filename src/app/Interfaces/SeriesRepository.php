<?php

namespace App\Interfaces;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\DTOs;
use App\Models;

interface SeriesRepository {
  /**
   *
   * @param DTOs\SerieFilterDTO $filter
   * @return Models\Serie[]|AnonymousResourceCollection
   */
  public function getAll(DTOs\SerieFilterDTO $filter);

  /**
   *
   * @param DTOs\SerieDTO $serie
   * @return Models\Serie
   */
  public function store(DTOs\SerieDTO $serie);

  /**
   *
   * @param int $serieId
   * @return Models\Serie
   */
  public function findOrFailId(int $serieId);

  /**
   *
   * @return Models\Serie[]
   */
  public function showSeriesSeasons();

  /**
   *
   * @return Models\Serie[]
   */
  public function showSeriesSeasonsEpisodes();

  /**
   * @param int $serieId
   * @return Models\Serie
   */
  public function showSerieSeasons(int $serieId);

  /**
   * @param int $serieId
   * @return Models\Serie
   */
  public function showSerieSeasonsEpisodes(int $serieId);

  /**
   * @param int $serieId
   * @return Models\Serie[]
   */
  public function showSeasonsBySerie(int $serieId);

  /**
   * @param int $serieId
   * @return Models\Serie[]
   */
  public function showEpisodesBySerie(int $serieId);

  /**
   * @param int $serieId
   * @return Models\Serie[]
   */
  public function showSeasonsEpisodesBySerie(int $serieId);

  /**
   * @param int $serieId
   * @param DTOs\SerieDTO $serie
   * @return Models\Serie
   */
  public function update(int $serieId, DTOs\SerieDTO $serie);

  /**
   * @param int $serieId
   * @return Models\Serie
   */
  public function destroy(int $serieId);
}
