<?php

namespace App\Repositories;

use App\Models\Spesimen;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class SpesimenRepository extends BaseRepository
{
  public function __construct(Spesimen $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): Spesimen|Model
  {
    return $this->model->create([
      'name' => $request->name,
      'desc' => $request->desc,
    ]);
  }

  public function update(int $id, stdClass $request): Spesimen
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'desc' => $request->desc,
    ]);
  }

  public function getAll(): Collection
  {
    return $this->model->select(['id', 'name'])->get();
  }
}
