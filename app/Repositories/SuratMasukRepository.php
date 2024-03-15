<?php

namespace App\Repositories;

use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class SuratMasukRepository extends BaseRepository
{
  public function __construct(SuratMasuk $x_model)
  {
    parent::__construct($x_model);
  }

  public function find(int $id): ?Model
  {
    return $this->model
      ->satker_scope()
      ->where('surat_masuks.id', $id)
      ->first();
  }

  public function table(): Builder
  {
    return $this->model
      ->satker_scope()
      ->with(['media', 'satker'])
      ->whereYear('date', date('Y'))
      ->orderBy('id', 'DESC');
  }

  public function getdataBetween(Carbon $fisrtDate, Carbon $lastDate): Collection
  {
    return $this->model
      ->satker_scope()
      ->whereBetween('date', [$fisrtDate, $lastDate])
      ->orderByDesc('date')
      ->get();
  }

  public function getCountByCurrentYear(): int
  {
    return $this->model
      ->satker_scope()
      ->whereYear('date', date('Y'))
      ->count();
  }

  public function store(stdClass $data): SuratMasuk
  {
    return $this->model
      ->create([
        'nomor' => $data->nomor,
        'date' => $data->date,
        'perihal' => $data->perihal,
        'asal' => $data->asal,
        'satker_id' => $data->satker_id,
        'desc' => $data->desc,

        'user_id' => auth()->user()->id,
      ]);
  }

  public function update(int $id, stdClass $data): SuratMasuk
  {
    return tap($this->find($id))
      ->update([
        'nomor' => $data->nomor,
        'date' => $data->date,
        'perihal' => $data->perihal,
        'asal' => $data->asal,
        'satker_id' => $data->satker_id,
        'desc' => $data->desc,
      ]);
  }
}
