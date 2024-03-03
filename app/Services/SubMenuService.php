<?php

namespace App\Services;

use App\Http\Requests\SubMenuRequest;
use App\Models\SubMenu;
use App\Repositories\SubMenuRepository;

class SubMenuService
{
  public function __construct(
    protected SubMenuRepository $repository
  ) {
  }

  public function find(int $id): SubMenu
  {
    return $this->repository->find($id);
  }

  public function store(SubMenuRequest $request): SubMenu
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, SubMenuRequest $request): SubMenu
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }
}
