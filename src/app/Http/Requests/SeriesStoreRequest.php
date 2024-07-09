<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class SeriesStoreRequest extends FormRequest
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
    return [
      'name' => ['required', 'min:2'],
      // 'attachment' => [
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
  //   $data = parent::all();

  //   if ($this->hasFile('attachment')) {
  //     $data['attachment'] = $this->saveFile();
  //   }

  //   return $data;
  // }
}
