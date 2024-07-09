<?php

namespace App\Interfaces;

use App\Models;
use App\DTOs;

interface SeasonsRepository {
  /**
   *
   * @param DTOs\SeasonDTO $season
   * @return Models\Season
   */
  public function store(DTOs\SeasonDTO $season);

  /**
   *
   * @param int $seasonId
   * @return Models\Season
   */
  public function findOrFailId(int $seasonId);

  /**
   * @param int $seasonId
   * @param DTOs\SeasonDTO $season
   * @return Models\Season
   */
  public function update(int $seasonId, DTOs\SeasonDTO $season);

  /**
   * @param DTOs\SeasonDTO $season
   * @return Models\Season
   */
  public function updateOrCreate(DTOs\SeasonDTO $season);

  /**
   * @param int $seasonId
   * @return Models\Season
   */
  public function destroy(int $seasonId);

  /**
   * @param int[] $seasonIds
   * @return bool|null
   */
  public function deleteNotInIds(int $seasonIds);

  /**
   * @param int $serieId
   * @return bool|null
   */
  public function deleteBySerieId(int $serieId);
}
