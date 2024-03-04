<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BerkasSuratRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'file' => ['required'],
    ];
  }
}
