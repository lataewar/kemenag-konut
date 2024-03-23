<?php

namespace App\Repositories;

use App\Models\Backup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class BackupRestoreRepository extends BaseRepository
{
  public function __construct(Backup $x_model)
  {
    parent::__construct($x_model);
  }

  public function all(): Collection
  {
    return $this->model->with(['user'])->latest()->get();
  }

  public function store(stdClass $request): Backup
  {
    return $this->model->create([
      'name' => $request->name,
      'user_id' => auth()->user()->id,
    ]);
  }
}
