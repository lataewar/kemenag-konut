<?php

namespace App\Services;

use App\Http\Requests\SpesimenRequest;
use App\Models\Spesimen;
use App\Repositories\SpesimenRepository;
use Illuminate\Database\Eloquent\Collection;

class SpesimenService
{
  public function __construct(
    protected SpesimenRepository $repository
  ) {
  }

  public function find(int $id): Spesimen
  {
    return $this->repository->find($id);
  }

  public function store(SpesimenRequest $request): Spesimen
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, SpesimenRequest $request): Spesimen
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

  public function getAll(): Collection
  {
    return $this->repository->getAll();
  }
}
