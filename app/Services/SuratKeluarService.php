<?php

namespace App\Services;

use App\Enums\SifatSuratEnum;
use App\Http\Requests\SuratKeluarRequest;
use App\Models\SuratKeluar;
use App\Repositories\SuratKeluarRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class SuratKeluarService
{
  public function __construct(
    protected SuratKeluarRepository $repository,
  ) {
  }

  private function getKombinasi(stdClass $data): stdClass
  {
    $kis = app(KodeInstansiService::class)->getKode();
    $kkl = app(KodeKlasifikasiService::class)->getKode($data->klasifikasi_id);
    $tgl = Carbon::createFromFormat('Y-m-d', $data->date)->isoFormat('/MM/Y');
    $sifat = ($data->sifat == SifatSuratEnum::BIASA->value) ? 'B-' : '';

    $sisipan = $data->sisipan ? '.' . $data->sisipan : '';

    $data->kombinasi = $data->nomor . $sisipan . '/' . $kis . $tgl;
    $data->full_nomor = $sifat . $data->nomor . $sisipan . '/' . $kis . '/' . $kkl . $tgl;

    return $data;
  }

  public function store(stdClass $data): SuratKeluar
  {
    $date = Carbon::parse($data->date)->startOfDay();
    $today = Carbon::now()->startOfDay();

    // if - date > today
    abort_if($date->gt($today), 422);

    // if Otomatis
    if ($data->is_otomatis) {
      $nomor = null;
      $sisipan = null;

      // if - date = today
      if ($date->eq($today))
        $nomor = $this->repository->getLastNomorByCurrentYear();

      // if - date < today
      else if ($date->lt($today)) {
        $firstDateOfYear = Carbon::parse($data->date)->startOfYear();
        $lastSurat = $this->repository->getLastNomorBetween($firstDateOfYear, $date);

        // if - last_num not exist (there is no surat by the beginning of the year - but there is surat after the taken date)
        if (!$lastSurat) {
          $nomor = 1;
          $sisipan = $this->repository->getLastSisipanByNomor($nomor);

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
          $sisipan = $this->repository->getLastSisipanByNomor($lastSurat);
          $nomor = $lastSurat;

          //  if - (last_num + 1) not exist (there is no surat after between the next taken date and today)
          if (!$this->repository->getLastNomorBetween($nextDate, $today)) {
            //  last_num + 1
            $nomor = $lastSurat + 1;
          }

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

      $data->nomor = $nomor;
      $data->sisipan = $sisipan;
    }

    $data = $this->getKombinasi($data);

    return $this->repository->store($data);
  }

  public function find(int $id): Model
  {
    return $this->repository->find($id);
  }

  /*
  public function update(int $id, SuratKeluarRequest $request): SuratKeluar
  {
    $data = (object) $request->validated();
    if (isset($data->password)) {
      return $this->repository->update($id, $data);
    }
    return $this->repository->updateWithoutPwd($id, $data);
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }

  public function multipleDelete(array $ids): bool
  {
    return $this->repository->multipleDelete($ids);
  }*/
}
