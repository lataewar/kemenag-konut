<?php

namespace App\Services;

use App\Http\Requests\SatkerRequest;
use App\Models\Satker;
use App\Repositories\SatkerRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SatkerService
{
  public function __construct(
    protected SatkerRepository $repository,
  ) {
  }

  public function find(int $id): Model
  {
    return $this->repository->find($id);
  }

  public function store(SatkerRequest $request): Satker
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, SatkerRequest $request): Satker
  {
    return $this->repository->update($id, (object) $request->validated());
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }

  public function multipleDelete(array $ids): bool
  {
    return $this->repository->multipleDelete($ids);
  }

  public function all(): Collection
  {
    return $this->repository->all();
  }
}
