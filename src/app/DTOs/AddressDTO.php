<?php

namespace App\DTOs;

class AddressDTO
{
  public function __construct(
    public string $cep = '',
    public string $address = '',
    public ?string $complement = null,
    public ?string $unit = null,
    public string $neighborhood = '',
    public ?CityDTO $city = null,
    public ?StateDTO $state = null,
    public string $ibge = '',
    public ?string $gia = null,
    public string $ddd = '',
    public string $siafi = '',
  ) {}

  /**
   *
   * @param object $attrs
   * @return self
   */
  public static function fill(object $attrs) {
    return new self(
      cep: $attrs?->cep ?? '',
      address: $attrs?->address ?? '',
      complement: $attrs?->complement ?? '',
      unit: $attrs?->unit ?? '',
      neighborhood: $attrs->neighborhood ?? '',
      city: $attrs->city ? CityDTO::fill($attrs->city) : null,
      state: $attrs->state ? StateDTO::fill($attrs->state) : null,
      ibge: $attrs?->ibge,
      gia: $attrs?->gia ?? null,
      ddd: $attrs->ddd,
      siafi: $attrs?->siafi
    );
  }
}
