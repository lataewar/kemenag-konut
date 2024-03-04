<?php

namespace App\Services\MediaLibrary;

use App\Repositories\TemporaryFileRepository;
use Illuminate\Database\Eloquent\Model;

class MediaLibraryService
{
  public function __construct(
    protected TemporaryFileRepository $repository
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
