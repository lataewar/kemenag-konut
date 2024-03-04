<?php

namespace App\Repositories;

use App\Enums\KategoriSuratEnum;
use App\Models\SuratKeluar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use stdClass;

class SuratKeluarRepository extends BaseRepository
{
  public function __construct(SuratKeluar $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model
      ->select(['id', 'nomor', 'full_nomor', 'perihal', 'tujuan', 'date', 'created_at'])
      ->with('media')
      ->orderBy('id', 'DESC');
  }

  public function getLastNomorByCurrentYear(): ?int
  {
    $nomor = $this->model
      ->whereYear('date', date('Y'))
      ->whereNull('sisipan')
      ->orderByDesc('id')
      ->first()
      ->nomor ?? 0;
    return $nomor + 1;
  }
  public function getLastNomorByCurrentYear_SK(): ?int
  {
    $nomor = $this->model
      ->whereYear('date', date('Y'))
      ->where('kategori', KategoriSuratEnum::SURAT_KEPUTUSAN->value)
      ->whereNull('sisipan')
      ->orderByDesc('id')
      ->first()
      ->nomor ?? 0;
    return $nomor + 1;
  }

  public function getLastNomorBetween(Carbon $fisrtDate, Carbon $lastDate): ?int
  {
    return $this->model
      ->whereBetween('date', [$fisrtDate, $lastDate])
      ->whereNull('sisipan')
      ->orderByDesc('id')
      ->first()
      ->nomor ?? null;
  }

  public function getLastNomorBetween_SK(Carbon $fisrtDate, Carbon $lastDate): ?int
  {
    return $this->model
      ->whereBetween('date', [$fisrtDate, $lastDate])
      ->whereNull('sisipan')
      ->where('kategori', KategoriSuratEnum::SURAT_KEPUTUSAN->value)
      ->orderByDesc('id')
      ->first()
      ->nomor ?? null;
  }

  public function getLastSisipanByNomor(int $nomor): ?string
  {
    return $this->model
      ->where('nomor', $nomor)
      ->orderByDesc('id')
      ->first()
      ->sisipan ?? null;
  }

  public function getLastSisipanByNomor_SK(int $nomor): ?string
  {
    return $this->model
      ->where('nomor', $nomor)
      ->where('kategori', KategoriSuratEnum::SURAT_KEPUTUSAN->value)
      ->orderByDesc('id')
      ->first()
      ->sisipan ?? null;
  }

  public function store(stdClass $data): SuratKeluar
  {
    return $this->model->create([
      'date' => $data->date,
      'klasifikasi_id' => $data->klasifikasi_id,
      'perihal' => $data->perihal,
      'kategori' => $data->kategori,
      'sifat' => $data->sifat,
      'spesimen_id' => $data->spesimen_id,
      'asal' => $data->asal,
      'tujuan' => $data->tujuan,
      'desc' => $data->desc,
      'is_otomatis' => $data->is_otomatis,

      'nomor' => $data->nomor,
      'kombinasi' => $data->kombinasi,
      'full_nomor' => $data->full_nomor,
      'sisipan' => $data->sisipan,

      'user_id' => auth()->user()->id,
    ]);
  }

  public function update(int $id, stdClass $data): SuratKeluar
  {
    return tap($this->find($id))->update([
      'klasifikasi_id' => $data->klasifikasi_id,
      'perihal' => $data->perihal,
      'sifat' => $data->sifat,
      'spesimen_id' => $data->spesimen_id,
      'asal' => $data->asal,
      'tujuan' => $data->tujuan,
      'desc' => $data->desc,
      'full_nomor' => $data->full_nomor,
    ]);
  }
}
