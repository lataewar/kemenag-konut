<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserService
{
  public function __construct(
    protected UserRepository $repository,
  ) {
  }

  public function find(int $id): Model
  {
    return $this->repository->find($id);
  }

  public function store(UserRequest $request): User
  {
    $user = $this->repository->store((object) $request->validated());
    $user->syncRoles($user->role_id->getName());
    return $user;
  }

  public function update(int $id, UserRequest $request): User
  {
    $user = isset($data->password) ?
      $this->repository->update($id, (object) $request->validated()) :
      $this->repository->updateWithoutPwd($id, (object) $request->validated());

    $user->syncRoles($user->role_id->getName());
    return $user;
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }

  public function multipleDelete(array $ids): bool
  {
    return $this->repository->multipleDelete($ids);
  }
}
