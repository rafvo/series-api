<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class EnsureTokenIsPresent
{
  public function handle(Request $request, Closure $next)
  {
    if (!$request->bearerToken()) {
      return response()->json(['message' => 'Token de autenticação não fornecido.'], 401);
    }

    return $next($request);
  }
}
