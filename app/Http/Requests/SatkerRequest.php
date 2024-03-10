<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SatkerRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'name' => ['required'],
      'kode' => ['required', 'max:10'],
      'desc' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    $this->merge(['kode' => substr($this->kode, 0, 10)]);
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Nama harus diisi.',
      'kode.required' => 'Kode harus diisi.',
      'kode.max' => 'Kode maksimal 10 karakter.',
    ];
  }
}
