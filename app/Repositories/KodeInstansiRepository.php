<?php

namespace App\Repositories;

use App\Models\KodeInstansi;
use stdClass;

class KodeInstansiRepository extends BaseRepository
{
  public function __construct(KodeInstansi $x_model)
  {
    parent::__construct($x_model);
  }

  public function first(): KodeInstansi
  {
    return $this->model->first();
  }

  public function update(int $id, stdClass $request): KodeInstansi
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'kode' => $request->kode,
      'desc' => $request->desc,
    ]);
  }

}
