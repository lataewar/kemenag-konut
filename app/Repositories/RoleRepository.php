<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class RoleRepository extends BaseRepository
{
  public function __construct(Role $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder|Model
  {
    return $this->model->withCount('menus');
  }

  public function store(stdClass $request): Role
  {
    return $this->model->create([
      'name' => $request->name,
      'desc' => $request->desc,
    ]);
  }

  public function update(int $id, stdClass $request): Role
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'desc' => $request->desc,
    ]);
  }

  public function findByIdWithMenus(int $id): ?Role
  {
    return $this->model->with([
      'menus' => function ($query) {
        $query->select('name', 'id');
      }
    ])->where('id', $id)->get()->first();
  }

  public function syncMenus(int $id, array $menus)
  {
    $model = $this->model->find($id);
    return $model->menus()->sync($menus);
  }
}
