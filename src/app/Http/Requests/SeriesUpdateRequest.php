<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class SeriesUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => ['nullable', 'min:2'],
      // 'attachment' => [
      //   'nullable',
      //   File::types(['pdf'])
      //     ->min('1kb')
      //     ->max('100kb'),
      // ],
    ];
  }

  // /**
  //  * Salva o arquivo localmente e retorna o caminho.
  //  *
  //  * @return string
  //  */
  // private function saveFile(): string
  // {
  //   $file = $this->file('attachment');

  //   return $file->store('uploads', 'public');
  // }

  // public function validated($key = null, $default = null)
  // {
  //   $data = parent::validated();

  //   if ($this->hasFile('attachment')) {
  //     $data['attachment'] = $this->saveFile();
  //   }

  //   return $data;
  // }
}
