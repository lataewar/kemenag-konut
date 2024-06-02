<?php

namespace App\Services;

use App\Enums\KategoriSuratEnum;
use App\Enums\SifatSuratEnum;
use App\Models\SuratKeluar;
use App\Repositories\SuratKeluarRepository;
use App\Services\MediaLibrary\MediaLibraryService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class SuratKeluarService
{
  public function __construct(
    protected SuratKeluarRepository $repository,
  ) {
  }

  public function find(int $id): ?Model
  {
    return $this->repository->find($id);
  }

  public function getCountNomorByCurrentYear(): int
  {
    return $this->repository->getCountNomorByCurrentYear();
  }

  public function getLastNomorByCurrentYear(): ?int
  {
    return $this->repository->getLastNomorByCurrentYear();
  }

  public function getLastNomorByCurrentYear_SK(): ?int
  {
    return $this->repository->getLastNomorByCurrentYear_SK();
  }

  private function getKombinasiNomor(stdClass $data): stdClass
  {
    $kis = app(KodeInstansiService::class)->getKode();
    $kkl = app(KodeKlasifikasiService::class)->getKode($data->klasifikasi_id);
    $month = Carbon::createFromFormat('Y-m-d', $data->date)->isoFormat('/MM');
    $year = Carbon::createFromFormat('Y-m-d', $data->date)->isoFormat('/Y');
    $sifat = ($data->sifat == SifatSuratEnum::BIASA->value) ? 'B-' : '';

    $sisipan = $data->sisipan ? '.' . $data->sisipan : '';

    $data->kombinasi = $data->nomor . $sisipan . '/' . $kis . $year;
    $data->full_nomor = $sifat . $data->nomor . $sisipan . '/' . $kis . '/' . $kkl . $month . $year;

    return $data;
  }

  private function getKombinasiNomor_SK(stdClass $data): stdClass
  {
    $year = Carbon::createFromFormat('Y-m-d', $data->date)->isoFormat('/Y');
    $sisipan = $data->sisipan ? '.' . $data->sisipan : '';

    $data->kombinasi = $data->nomor . $sisipan . '/' . 'SK/' . $year;
    $data->full_nomor = $data->nomor . $sisipan;
    $data->klasifikasi_id = 0;

    return $data;
  }

  private function getSuratKeluar(stdClass $data, Carbon $date, Carbon $today): stdClass
  {
    $isNomorBiasa = $data->kategori == KategoriSuratEnum::SURAT_KELUAR->value;

    // if Otomatis
    if ($data->is_otomatis) {
      $nomor = null;
      $sisipan = null;


      // if - date = today
      if ($date->eq($today)) {
        $nomor = $isNomorBiasa ?
          $this->getLastNomorByCurrentYear() :
          $this->getLastNomorByCurrentYear_SK();
      }

      // if - date < today
      else if ($date->lt($today)) {
        $firstDateOfYear = Carbon::parse($data->date)->startOfYear();
        $lastSurat = $isNomorBiasa ?
          $this->repository->getLastNomorBetween($firstDateOfYear, $date) :
          $this->repository->getLastNomorBetween_SK($firstDateOfYear, $date);

        // if - last_num not exist (there is no surat by the beginning of the year - but there is surat after the taken date)
        if (!$lastSurat) {
          $nomor = 1;
          $sisipan = $isNomorBiasa ?
            $this->repository->getLastSisipanByNomor($nomor) :
            $this->repository->getLastSisipanByNomor_SK($nomor);

          //  if - sisipan not exist
          if (!$sisipan) {
            //  last_num = 1 & sisipan = a
            $sisipan = 'a';
          }

          //  if - sisipan exist
          else
            //  last_num = 1 & (sisipan + 1)
            $sisipan++;
        }

        // else if - last_num exist (there is surat before the taken date)
        else {
          $nextDate = $date->addDay();
          $sisipan = $isNomorBiasa ?
            $this->repository->getLastSisipanByNomor($lastSurat) :
            $this->repository->getLastSisipanByNomor_SK($lastSurat);

          $nomor = $lastSurat;

          //  if - (last_num + 1) not exist (there is no surat after between the next taken date and today)
          $isNextExist = $isNomorBiasa ?
            $this->repository->getLastNomorBetween($nextDate, $today) :
            $this->repository->getLastNomorBetween_SK($nextDate, $today);

          if (!$isNextExist) {
            //  last_num + 1
            $nomor = $lastSurat + 1;

          } else { //  else - (last_num + 1) is exist (there is surat after between the next taken date and today)

            //  if - sisipan not exist
            if (!$sisipan) {
              //  last_num & sisipan = a
              $sisipan = 'a';
            }

            //  if - sisipan exist
            else
              //  last_num & (sisipan + 1)
              $sisipan++;
          }

        }

      }

      $data->nomor = $nomor;
      $data->sisipan = $sisipan;
    }

    $data = $isNomorBiasa ? $this->getKombinasiNomor($data) : $this->getKombinasiNomor_SK($data);

    return $data;
  }

  public function check(stdClass $data): JsonResponse
  {
    $isNomorBiasa = $data->kategori == KategoriSuratEnum::SURAT_KELUAR->value;
    $firstDateOfYear = Carbon::parse($data->data)->startOfYear();
    $date = Carbon::parse($data->data)->startOfDay();

    $nomor = ($isNomorBiasa ?
      $this->repository->getLastNomorBetween($firstDateOfYear, $date) :
      $this->repository->getLastNomorBetween_SK($firstDateOfYear, $date)) ?? 1;

    return response()->json(['data' => $nomor]);
  }

  public function store(stdClass $data): SuratKeluar
  {
    $date = Carbon::parse($data->date)->startOfDay();
    $today = Carbon::now()->startOfDay();

    // if - date > today
    abort_if($date->gt($today), 422);

    $data = $this->getSuratKeluar($data, $date, $today);

    return $this->repository->store($data);
  }

  public function update(int $id, stdClass $object): SuratKeluar
  {
    $data = $this->find($id);

    $object->date = $data->date;
    $object->sisipan = $data->sisipan;
    $object->nomor = $data->nomor;

    $object = $data->kategori->isSuratKeluar() ?
      $this->getKombinasiNomor($object) :
      $this->getKombinasiNomor_SK($object);

    return $this->repository->update($id, $object);
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
