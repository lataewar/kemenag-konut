<?php

namespace App\Services;

use App\Models\SuratMasuk;
use App\Repositories\SuratMasukRepository;
use App\Services\MediaLibrary\MediaLibraryService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class SuratMasukService
{
  public function __construct(
    protected SuratMasukRepository $repository,
  ) {
  }

  public function find(int $id): ?Model
  {
    return $this->repository->find($id);
  }

  public function getCountByCurrentYear(): int
  {
    return $this->repository->getCountByCurrentYear();
  }

  public function store(stdClass $data): SuratMasuk|bool
  {
    DB::beginTransaction();
    try {
      $suratmasuk = $this->repository->store($data);
      if ($data->file)
        app(MediaLibraryService::class)->store($suratmasuk, $data->file, $suratmasuk->nomor);

      DB::commit();
      return $suratmasuk;
    } catch (Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function update(int $id, stdClass $data): SuratMasuk|bool
  {
    DB::beginTransaction();
    try {
      $suratmasuk = $this->repository->update($id, $data);
      if ($data->file)
        app(MediaLibraryService::class)->store($suratmasuk, $data->file, $suratmasuk->nomor);

      DB::commit();
      return $suratmasuk;
    } catch (Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }

  public function multipleDelete(array $ids): bool
  {
    return $this->repository->multipleDelete($ids);
  }

  public function storeBerkas(int $id, stdClass $data): bool
  {
    $mediaLibService = app(MediaLibraryService::class);

    DB::beginTransaction();
    try {
      $surat = $this->find($id);
      $mediaLibService->store($surat, $data->file, $surat->full_nomor);

      DB::commit();
      return true;
    } catch (Exception $e) {
      DB::rollback();
      return false;
    }
  }
}
