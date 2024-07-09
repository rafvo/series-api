<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services;

class UsersController extends Controller
{
	public function __construct(
		private User $user,
	) {
	}

	public function index()
	{
		return $this->user::all();
	}

	public function register(Request $request)
	{
		$user = $this->user::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		return response()->json(
			[
				'message' => 'Usuário registrado com sucesso',
				'user' => $user,
			]
		);
	}
}
