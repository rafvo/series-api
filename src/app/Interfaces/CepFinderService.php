<?php

namespace App\Interfaces;

use App\DTOs;

interface CepFinderService {
  /**
   *
   * @param string $cep
   * @return DTOs\AddressDTO
   */
  public function getAddressByCEP(string $cep);
}