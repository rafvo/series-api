<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeasonsStoreRequest extends FormRequest
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
    $serieId = $this->input('serie_id');

    return [
      'name' => [
        'required',
      ],
      'number' => [
        'required',
        Rule::unique('seasons')->where(function ($query) use ($serieId) {
          $query->where('serie_id', $serieId);
        }),
      ],
      'serie_id' => [
        'required',
        'integer',
      ],
    ];
  }
}
