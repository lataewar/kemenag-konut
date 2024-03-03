<?php

namespace App\Repositories;

use App\Models\KodeKlasifikasi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class KodeKlasifikasiRepository extends BaseRepository
{
  public function __construct(KodeKlasifikasi $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): KodeKlasifikasi|Model
  {
    return $this->model->create([
      'name' => $request->name,
      'kode' => $request->kode,
      'desc' => $request->desc,
    ]);
  }

  public function update(int $id, stdClass $request): KodeKlasifikasi
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'kode' => $request->kode,
      'desc' => $request->desc,
    ]);
  }

  public function getAll(): Collection
  {
    return $this->model->get();
  }
}
