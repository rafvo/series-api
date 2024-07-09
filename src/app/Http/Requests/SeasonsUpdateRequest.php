<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeasonsUpdateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    $id = $this->route('id');
    $serieId = $this->input('serie_id');

    return [
      'serie_id' => [
        'required',
        'integer',
        Rule::exists('series', 'id'),
      ],
      'name' => [
        'required',
      ],
      'number' => [
        'required',
        Rule::unique(table: 'seasons')->where(function ($query) use ($id, $serieId) {
          $query->where('serie_id', $serieId)->where('id', '!=', $id);
        }),
      ],
    ];
  }
}
