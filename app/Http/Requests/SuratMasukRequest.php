<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
{
  public function rules()
  {
    return [
      'date' => ['required', 'date_format:Y-m-d'],
      'nomor' => ['required'],
      'perihal' => ['required'],
      'asal' => ['required'],
      'satker_id' => ['required'],

      'file' => [],
      'desc' => [],
    ];
  }

  protected function prepareForValidation(): void
  {
    if (!$this->file)
      $this->merge([
        'file' => '',
      ]);
  }

  public function messages()
  {
    return [
      'perihal.required' => 'Perihal Surat harus diisi.',
      'date.required' => 'Tanggal harus diisi.',
      'date.date_format' => 'Format tanggal salah.',
      'satker_id.required' => 'Tujuan Surat harus dipilih.',
      'nomor.required' => 'Nomor Surat harus diisi.',
      'asal.required' => 'Asal Surat harus diisi.',
    ];
  }
}
