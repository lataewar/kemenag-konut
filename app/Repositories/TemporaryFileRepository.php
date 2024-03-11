<?php

namespace App\Repositories;

use App\Models\TemporaryFile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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

  public function deleteTemporary(): void
  {
    $this->model->whereTime('created_at', '<=', Carbon::now()->subMinutes(10))->get()->each(function ($item) {
      $item->delete();
    });
  }
}
