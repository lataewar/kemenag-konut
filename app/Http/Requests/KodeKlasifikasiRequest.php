<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KodeKlasifikasiRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'kode' => 'required|max:20',
      'name' => 'required',
      'desc' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'kode.required' => 'Kode harus diisi.',
      'kode.max' => 'Maksimal 20 digit.',
      'name.required' => 'Nama harus diisi.',
      'desc.required' => 'Keterangan harus diisi.',
    ];
  }
}
