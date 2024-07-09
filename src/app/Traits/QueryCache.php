<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait QueryCache
{
  protected function queryCache(Request $request, Builder $query, int $cacheDuration = 600)
  {
    // Gerar uma chave de cache única com base na URL completa
    $cacheKey = $this->getCacheKey($request);

    // Retornar resultados armazenados no cache ou executar a consulta e armazenar o resultado
    return Cache::remember($cacheKey, $cacheDuration, function () use ($query) {
      return $query;
    });
  }

  protected function getCacheKey(Request $request)
  {
    // Gerar uma chave de cache única baseada na URL completa da requisição
    return 'cache_' . md5($request->fullUrl());
  }
}
