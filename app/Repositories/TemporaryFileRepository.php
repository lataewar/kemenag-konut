<?php

namespace App\Repositories;

use App\Models\TemporaryFile;

class TemporaryFileRepository extends BaseRepository
{
  public function __construct(TemporaryFile $x_model)
  {
    parent::__construct($x_model);
  }

  public function getFolder(string $uuid): ?TemporaryFile
  {
    return $this->model->where('folder', $uuid)->first();
  }
}
