<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CetakSuratKeluarRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'start' => ['required', 'required_with:end', 'date_format:Y-m-d', 'before_or_equal:end'],
      'end' => ['required', 'required_with:start', 'date_format:Y-m-d', 'after_or_equal:start'],
    ];
  }

  public function messages(): array
  {
    return [
      'start.required_with' => 'Isian waktu pengajuan harus diisi.',
      'end.required_with' => 'Isian waktu pengajuan harus diisi.',
      'start.before_or_equal' => 'Isian -dari- harus berupa tanggal sebelum isian -hingga-',
      'end.after_or_equal' => 'Isian -hingga- harus berupa tanggal setelah isian -dari-',
      'start.date_format' => 'Format isian waktu pengajuan kurang tepat.',
      'end.date_format' => 'Format isian waktu pengajuan kurang tepat.',
    ];
  }
}
