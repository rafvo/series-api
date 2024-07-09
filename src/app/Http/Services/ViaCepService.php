<?php

namespace App\Http\Services;

use Exception;
use App\Interfaces;
use App\DTOs;

class ViaCepService implements Interfaces\CepFinderService
{
  public function __construct(
    private Interfaces\HttpClientInterface $client,
    private Interfaces\CitiesRepository $citiesRepository,
    private Interfaces\StatesRepository $statesRepository,
    private DTOs\AddressDTO $addressDTO,
  ) {
  }

  public function getAddressByCEP(string $cep): DTOs\AddressDTO
  {
    try {
      $url = "https://viacep.com.br/ws/{$cep}/json/";

      $response = $this->client->request(method: 'GET', url: $url);
      $data = (object)json_decode($response->getBody(), true);

      $city = $this->citiesRepository->getByIbgeCode(ibgeCode: $data->ibge);
      $state = $this->statesRepository->getById(id: $city->state_id);

      return $this->addressDTO::fill(attrs: (object)[
        'cep' => $data->cep,
        'address' => $data->logradouro,
        'complement' =>$data->complemento,
        'unit' => $data->unidade,
        'neighborhood' => $data->bairro,
        'city' => $city,
        'state' => $state,
        'ibge' => $data->ibge,
        'gia' => $data->gia,
        'ddd' => $data->ddd,
        'siafi' => $data->siafi
      ]);
    } catch (Exception $e) {
      return response()->json(['error' => 'Erro ao buscar endereço.'], 500);
    }
  }
}
