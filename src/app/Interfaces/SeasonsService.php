<?php

namespace App\Interfaces;

use App\Models;
use App\DTOs;

interface SeasonsService {
  /**
   *
   * @param DTOs\SeasonDTO $season
   * @return Models\Season
   */
  public function store(DTOs\SeasonDTO $season);

  /**
   *
   * @param int $serieId
   * @param DTOs\SeasonDTO[] $seasons
   * @return void
   */
  public function arrayStore(int $serieId, array $seasons);

  /**
   *
   * @param int $seasonId
   * @param DTOs\SeasonDTO $season
   * @return Models\Season
   */
  public function update(int $seasonId, DTOs\SeasonDTO $season);

  /**
   *
   * @param int $serieId
   * @param int[] $seasonIds
   * @return void
   */
  public function deleteNotUpdatedSeasons(int $serieId, array $seasonIds);

  /**
   *
   * @param int $serieId
   * @param DTOs\SeasonDTO[] $seasons
   * @return void
   */
  public function updateOrCreateSeasons(int $serieId, array $seasons);

  /**
   *
   * @param int $serieId
   * @param DTOs\SeasonDTO[] $seasons
   * @return void
   */
  public function arrayUpdate(int $serieId, array $seasons);

  /**
   *
   * @param int $seasonId
   * @return Models\Season
   */
  public function destroy(int $seasonId);
}
