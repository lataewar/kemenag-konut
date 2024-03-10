<?php

namespace App\Services;

use App\Http\Requests\RoleRequest;
use App\Repositories\PermissionRepository;
use Spatie\Permission\Models\Permission;

class PermissionService
{
  public function __construct(
    protected PermissionRepository $repository
  ) {
  }

  public function find(int $id): Permission
  {
    return $this->repository->find($id);
  }

  public function store(RoleRequest $request): Permission
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, RoleRequest $request): Permission
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
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
