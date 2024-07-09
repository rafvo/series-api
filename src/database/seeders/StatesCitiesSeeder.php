<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class StatesCitiesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * php artisan db:seed --class=StatesCitiesSeeder
   */
  public function run(): void
  {
    /*
      Obter estados:
      https://servicodados.ibge.gov.br/api/v1/localidades/estados

      Obter municípios de um estado (substitua {UF} pela sigla do estado, como "SP" para São Paulo):
      https://servicodados.ibge.gov.br/api/v1/localidades/estados/{UF}/municipios
    */
    $json = File::get("database/data/statesAndCities.json");
    $data = json_decode($json);

    foreach ($data as $state) {
      DB::table('states')->insert([
        'id' => $state->id,
        'name' => $state->nome,
        'abbreviation' => $state->sigla,
      ]);

      foreach ($state->cidades as $city) {
        DB::table('cities')->insert([
          'name' => $city->nome,
          'state_id' => $state->id,
          'ibge_code' => $city->id,
        ]);
      }
    }
  }
}
