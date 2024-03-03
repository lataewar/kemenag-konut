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
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, UserRequest $request): User
  {
    $data = (object) $request->validated();
    if (isset($data->password)) {
      return $this->repository->update($id, $data);
    }
    return $this->repository->updateWithoutPwd($id, $data);
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
