<?php

namespace App\Interfaces;

use App\Models;
use App\DTOs;

interface SeriesService {
  /**
   *
   * @param DTOs\SerieDTO $serie
   * @return Models\Serie
   */
  public function store(DTOs\SerieDTO $serie);

  /**
   *
   * @param int $serieId
   * @param DTOs\SerieDTO $serie
   * @return Models\Serie
   */
  public function update(int $serieId, DTOs\SerieDTO $serie);

  /**
   *
   * @param int $serieId
   * @return Models\Serie
   */
  public function destroy(int $serieId);
}
