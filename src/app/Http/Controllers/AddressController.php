<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Interfaces;

class AddressController extends Controller
{
	public function __construct(
		private Interfaces\CepFinderService $cepFinderService
	) {
	}

	public function getAddressByCEP(Request $request)
	{
		try {
			$cep = $request->input('cep');
			$address = $this->cepFinderService->getAddressByCEP($cep);

			return response()->json($address);
		} catch (Exception $e) {
			return response()->json(['error' => 'Erro ao buscar endereço.'], 500);
		}
	}
}
