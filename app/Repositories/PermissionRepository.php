<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Permission;
use stdClass;

class PermissionRepository extends BaseRepository
{
  public function __construct(Permission $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): Permission
  {
    return $this->model->create([
      'name' => $request->name,
      'guard_name' => 'web',
    ]);
  }

  public function update(int $id, stdClass $request): Permission
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
    ]);
  }

  public function getAllPluck()
  {
    return $this->model->pluck('name');
  }
}
