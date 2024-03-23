<?php

namespace App\Services;

use App\Repositories\BackupRestoreRepository;
use Illuminate\Database\Eloquent\Collection;

class BackupRestoreService
{
  public function __construct(
    protected BackupRestoreRepository $repository
  ) {
  }

  public function all(): Collection
  {
    return $this->repository->all();
  }

}
