<?php

namespace App\Repositories;

use App\Models\Satker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class SatkerRepository extends BaseRepository
{
  public function __construct(Satker $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): Satker
  {
    return $this->model->create([
      'name' => $request->name,
      'kode' => $request->kode,
      'desc' => $request->desc,
    ]);
  }

  public function update(int $id, stdClass $request): Satker
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'kode' => $request->kode,
      'desc' => $request->desc,
    ]);
  }

  public function all(): Collection
  {
    return $this->model->select(['id', 'name'])->get();
  }
}
