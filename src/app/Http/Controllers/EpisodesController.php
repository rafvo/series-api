<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use App\DTOs;
use App\Interfaces;
use App\Http\Requests;

class EpisodesController extends Controller
{
	public function __construct(
		private Interfaces\EpisodesService $episodeService,
	) {
	}

	public function store(Requests\EpisodesStoreRequest $request, DTOs\EpisodeDTO $episode)
	{
		$episode = $episode::fill(attrs: (object)$request->all());
		$episode = $this->episodeService->store(episode: $episode);

		return response()->json(data: $episode, status: 201);
	}

	public function update(Requests\EpisodesUpdateRequest $request, int $episodeId, DTOs\EpisodeDTO $episode)
	{
		$episode = $episode::fill(attrs: (object)$request->all());
		$episode = $this->episodeService->update(episodeId: $episodeId, episode: $episode);

		return response()->json(
			data: [
				'message' => 'Episódio atualizado com sucesso!',
				'episode' => $episode,
			],
			status: 200
		);
	}

	public function watched(Requests\EpisodesUpdateRequest $request, int $episodeId)
	{
		$episode = $this->episodeService->watched(episodeId: $episodeId);

		return response()->json(
			data: [
				'message' => 'O episódio foi atualizado como assistido com sucesso!',
				'episode' => $episode,
			],
			status: 200
		);
	}

	public function unwatched(Requests\EpisodesUpdateRequest $request, int $episodeId)
	{
		$episode = $this->episodeService->unwatched(episodeId: $episodeId);

		return response()->json(
			data: [
				'message' => 'O episódio foi atualizado como não assistido com sucesso!',
				'episode' => $episode,
			],
			status: 200
		);
	}

	public function destroy(int $episodeId, Authenticatable $user)
	{
		$this->episodeService->destroy(episodeId: $episodeId);

		return response()->json(
			data: [
				'message' => 'Episódio removido com sucesso!',
			],
			status: 200
		);
	}
}
