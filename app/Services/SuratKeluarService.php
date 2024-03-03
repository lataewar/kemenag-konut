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

  private function getKombinasi(stdClass $data): string
  {
    $kis = app(KodeInstansiService::class)->getKode();
    $kkl = app(KodeKlasifikasiService::class)->getKode($data->klasifikasi_id);
    $tgl = Carbon::createFromFormat('Y-m-d', $data->date)->isoFormat('/MM/Y');
    $sifat = ($data->sifat == SifatSuratEnum::BIASA->value) ? 'B-' : '';

    $kombinasi = $sifat . $data->nomor . '/' . $kis . '/' . $kkl . $tgl;

    return $kombinasi;
  }

  public function store(stdClass $data)
  {
    $date = Carbon::parse($data->date)->startOfDay();
    $today = Carbon::now()->startOfDay();

    abort_if($date->gt($today), 422);

    // Jika Menggunakan Metode Otomatis
    if ($data->is_otomatis) {
      $nomor = null;

      if ($date->eq($today))
        $nomor = $this->repository->getLastNomorByCurrentYear();

      $data->nomor = $nomor;
    }

    // return $data;

    $data->kombinasi = $this->getKombinasi($data);

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
