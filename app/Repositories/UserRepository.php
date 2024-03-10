<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use stdClass;

class UserRepository extends BaseRepository
{
  public function __construct(User $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): User|Model
  {
    return $this->model->create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role_id' => $request->role_id,
      'satker_id' => $request->satker_id,
    ]);
  }

  public function update(int $id, stdClass $request): User
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'role_id' => $request->role_id,
      'satker_id' => $request->satker_id,
    ]);
  }

  public function updateWithoutPwd(int $id, stdClass $request): User
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'email' => $request->email,
      'role_id' => $request->role_id,
      'satker_id' => $request->satker_id,
    ]);
  }
}
