<?php

namespace App\Services;

use App\Http\Requests\KodeKlasifikasiRequest;
use App\Models\KodeInstansi;
use App\Repositories\KodeInstansiRepository;

class KodeInstansiService
{
  public function __construct(
    protected KodeInstansiRepository $repository
  ) {
  }

  public function first(): KodeInstansi
  {
    return $this->repository->first();
  }

  public function update(int $id, KodeKlasifikasiRequest $request): KodeInstansi
  {
    $validated = (object) $request->validated();
    return $this->repository->update($id, $validated);
  }

  public function getKode(): string
  {
    return $this->first()->kode ?? '-';
  }
}
