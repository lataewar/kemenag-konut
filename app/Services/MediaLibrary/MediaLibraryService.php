<?php

namespace App\Services\MediaLibrary;

use App\Repositories\Interfaces\TemporaryFileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class MediaLibraryService
{
  public function __construct(
    protected TemporaryFileRepositoryInterface $repository
  ) {
  }

  public function store(Model $model, string $uuid, string $collection_name = 'default'): void
  {
    $tempFile = $this->repository->getFolder($uuid);
    if ($tempFile) {
      $path = 'app/public/files/tmp/' . $uuid . '/';

      $model
        ->addMedia(storage_path($path . $tempFile->filename))
        ->toMediaCollection($collection_name);

      rmdir(storage_path($path));
      $this->repository->delete($tempFile->id);
    }
  }
}
