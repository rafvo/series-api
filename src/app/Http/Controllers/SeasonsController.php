<?php

namespace App\Http\Controllers;

use App\DTOs;
use App\Interfaces;
use App\Http\Requests;

class SeasonsController extends Controller
{
	public function __construct(
		private Interfaces\SeasonsService $seasonService,
	) {
	}

	public function store(Requests\SeasonsStoreRequest $request, DTOs\SeasonDTO $season)
	{
		$season = $season::fill(attrs: (object) $request->all());
		$season = $this->seasonService->store(season: $season);

		return response()->json(data: $season, status: 201);
	}

	public function update(Requests\SeasonsUpdateRequest $request, int $seasonId, DTOs\SeasonDTO $season)
	{
		$season = $season::fill(attrs: (object) $request->all());
		$season = $this->seasonService->update(seasonId: $seasonId, season: $season);

		return response()->json(
			data: [
				'message' => 'Temporada atualizada com sucesso!',
				'season' => $season,
			],
			status: 200
		);
	}

	public function destroy(int $seasonId)
	{
		$this->seasonService->destroy(seasonId: $seasonId);

		return response()->json(
			data: [
				'message' => 'Temporada removida com sucesso!',
			],
			status: 200
		);
	}
}
