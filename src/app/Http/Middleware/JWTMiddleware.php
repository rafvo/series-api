<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Services;
use App\Exceptions\TokenInvalidException;

class JWTMiddleware
{
	public function __construct(private Services\EmarrefJwtService $jwtService)
	{

	}

	public function handle(Request $request, Closure $next) {
		try {
			// Obtém a string do token JWT a partir do cabeçalho Authorization
			$tokenString = $request->bearerToken();

			// Verifica se o token foi fornecido
			if (!$tokenString) {
				throw new TokenInvalidException('Token não fornecido');
			}

			// Verifica a validade do token usando o serviço JWT
			$this->jwtService->verifyToken($tokenString);

			// Continua para a próxima etapa do middleware
			return $next($request);
		} catch (TokenInvalidException $e) {
			// Retorna uma resposta de erro se o token for inválido ou não fornecido
			return response()->json(['error' => $e->getMessage()], $e->getCode());
		}
	}
}