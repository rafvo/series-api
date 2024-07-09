<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

	public function __construct(
		private User $user,
	) {
	}

	public function login(Request $request)
	{
		$credentials = $request->only(["email", "password"]);

		if (Auth::attempt($credentials) === false) {
			return response()->json(['error' => 'Não autorizado'], 401);
		}

		$user = Auth::user();
		$user->tokens()->delete();
		$token = $user->createToken(name: 'token', abilities: ['episode:delete'])->plainTextToken;

		return response()->json([
			'token' => $token
		], 200);
	}

	public function logout(Request $request, Authenticatable $user)
	{
		$user->tokens()->delete();

		return response()->json([
			'message' => 'Usuário deslogado com sucesso'
		], 200);
	}
}
