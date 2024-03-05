<?php

namespace App\Services\MediaLibrary;

use App\Repositories\TemporaryFileRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MediaLibraryService
{
  public function __construct(
    protected TemporaryFileRepository $repository
  ) {
  }

  public function store(Model $model, string $uuid, string $filename, string $collection_name = 'default'): void
  {
    $tempFile = $this->repository->getFolder($uuid);
    if ($tempFile) {
      $path = 'app/public/files/tmp/' . $uuid . '/';
      $filename = Str::slug($filename);
      $file_ext = File::extension(storage_path($path . $tempFile->filename));

      $model
        ->addMedia(storage_path($path . $tempFile->filename))
        ->usingFileName($filename . '.' . $file_ext)
        ->toMediaCollection($collection_name);

      rmdir(storage_path($path));
      $this->repository->delete($tempFile->id);
    }
  }
}
