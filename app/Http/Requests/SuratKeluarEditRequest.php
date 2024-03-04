<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKeluarEditRequest extends FormRequest
{
  public function rules()
  {
    $rules = [
      'klasifikasi_id' => ['required'],
      'perihal' => ['required'],
      'sifat' => [],
      'spesimen_id' => [],
      'asal' => [],
      'tujuan' => [],
      'desc' => [],
    ];

    return $rules;
  }

  // protected function prepareForValidation(): void
  // {
  //   $this->merge([
  //     'has_submenu' => $this->has_submenu ? true : false,
  //   ]);
  // }

  public function messages()
  {
    return [
      'klasifikasi_id.required' => 'Klasifikasi Surat harus dipilih.',
      'perihal.required' => 'Perihal Surat harus diisi.',
    ];
  }
}
