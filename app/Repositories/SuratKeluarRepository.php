<?php

namespace App\Repositories;

use App\Enums\KategoriSuratEnum;
use App\Models\SuratKeluar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class SuratKeluarRepository extends BaseRepository
{
  public function __construct(SuratKeluar $x_model)
  {
    parent::__construct($x_model);
  }

  public function find(int $id): ?Model
  {
    return $this->model
      ->findsatker_scope()
      ->where('surat_keluars.id', $id)
      ->first();
  }

  public function table(): Builder
  {
    return $this->model
      ->satker_scope()
      ->select([
        'surat_keluars.id',
        'surat_keluars.date',
        'surat_keluars.nomor',
        'surat_keluars.full_nomor',
        'surat_keluars.created_at',
        'surat_keluars.perihal',
        'surat_keluars.tujuan',
        'surat_keluars.asal',
        'users.name as user_name',
      ])
      ->join('users', 'users.id', '=', 'surat_keluars.user_id')
      ->with('media')
      ->whereYear('date', date('Y'))
      ->orderBy('id', 'DESC');
  }

  public function getCountNomorByCurrentYear(): int
  {
    return $this->model
      ->satker_scope()
      ->join('users', 'users.id', '=', 'surat_keluars.user_id')
      ->whereYear('date', date('Y'))
      ->count();
  }

  public function getdataBetween(Carbon $fisrtDate, Carbon $lastDate): Collection
  {
    return $this->model
      ->satker_scope()
      ->join('users', 'users.id', '=', 'surat_keluars.user_id')
      ->whereBetween('date', [$fisrtDate, $lastDate])
      ->orderByDesc('date')
      ->get();
  }

  public function getLastNomorByCurrentYear(): ?int
  {
    $nomor = $this->model
      ->whereYear('date', date('Y'))
      ->whereNull('sisipan')
      ->where('kategori', KategoriSuratEnum::SURAT_KELUAR->value)
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
      ->where('kategori', KategoriSuratEnum::SURAT_KELUAR->value)
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
    return tap($this->find($id))
      ->update([
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
