<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKeluarRequest extends FormRequest
{
  public function rules()
  {
    $rules = [
      'date' => ['required', 'date_format:Y-m-d', 'before:tomorrow'],
      'klasifikasi_id' => ['required'],
      'perihal' => ['required'],

      'kategori' => [],
      'sifat' => [],
      'asal' => [],
      'tujuan' => [],
      'spesimen_id' => [],
      'desc' => [],

      'is_otomatis' => [],
    ];

    if (!request()->is_otomatis) {
      $rules += ['nomor' => ['required']];
      $rules += ['sisipan' => []];
    }

    return $rules;
  }

  public function messages()
  {
    return [
      'perihal.required' => 'Perihal Surat harus diisi.',
      'date.required' => 'Tanggal harus diisi.',
      'date.date_format' => 'Format tanggal salah.',
      'date.before' => 'Tanggal masksimal hari ini.',
      'klasifikasi_id.required' => 'Klasifikasi Surat harus dipilih.',
      'nomor.required' => 'Nomor Surat harus diisi.',
    ];
  }
}
