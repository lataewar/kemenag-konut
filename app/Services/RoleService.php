<?php

namespace App\Services;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repositories\MenuRepository;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
  public function __construct(
    protected RoleRepository $repository
  ) {
  }

  public function find(int $id): Role
  {
    return $this->repository->find($id);
  }

  public function store(RoleRequest $request): Role
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, RoleRequest $request): Role
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }

  public function createAkses(int $id)
  {
    $menuRepo = app(MenuRepository::class);
    return [
      'app' => (object) [
        'data' => $this->repository->findByIdWithMenus($id),
        'menus' => $menuRepo->all(),
      ]
    ];
  }

  public function syncAkses(int $id, array $menus)
  {
    return $this->repository->syncMenus($id, $menus);
  }
}
