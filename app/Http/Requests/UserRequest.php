<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
  public function rules()
  {
    // if edit without changing password
    if (isset(request()->r_type) && !request()->password) {
      return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email, ' . request()->id . ',id',
        'role_id' => 'required',
        // 'satker_id' => ['required_if:role_id,4'],
        'satker_id' => Rule::requiredIf(fn() => request()->role_id == UserRole::SATKER->value),
      ];
    }

    return [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email, ' . request()->id . ',id',
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role_id' => 'required',
      'satker_id' => Rule::requiredIf(fn() => request()->role_id == UserRole::SATKER->value),
    ];
  }

  protected function prepareForValidation(): void
  {
    if (request()->role_id != UserRole::SATKER->value)
      $this->merge([
        'satker_id' => null,
      ]);
  }

  public function messages()
  {
    return [
      'role_id.required' => 'Role is required.',
    ];
  }
}
