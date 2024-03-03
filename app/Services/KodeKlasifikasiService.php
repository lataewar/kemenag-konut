<?php

namespace App\Services;

use App\Http\Requests\KodeKlasifikasiRequest;
use App\Models\KodeKlasifikasi;
use App\Repositories\KodeKlasifikasiRepository;
use Illuminate\Support\Collection;

class KodeKlasifikasiService
{
  public function __construct(
    protected KodeKlasifikasiRepository $repository
  ) {
  }

  public function find(int $id): KodeKlasifikasi
  {
    return $this->repository->find($id);
  }

  public function store(KodeKlasifikasiRequest $request): KodeKlasifikasi
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, KodeKlasifikasiRequest $request): KodeKlasifikasi
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

  public function getSelectionData(): Collection
  {
    $array = [];
    foreach ($this->repository->getAll() as $item) {
      array_push($array, [
        'id' => $item->id,
        'name' => $item->kode . ', ' . $item->name . ', ' . $item->desc,
      ]);
    }

    return collect($array);
  }

  public function getKode(int $id): string
  {
    return $this->find($id)->kode ?? '-';
  }
}
