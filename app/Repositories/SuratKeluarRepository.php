<?php

namespace App\Repositories;

use App\Models\SuratKeluar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class SuratKeluarRepository extends BaseRepository
{
  public function __construct(SuratKeluar $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->select(['id', 'nomor', 'kombinasi', 'perihal', 'tujuan', 'date', 'created_at'])->with('media')->latest();
  }

  public function getLastNomorByCurrentYear(): int
  {
    return $this->model->whereYear('date', date('Y'))->max('nomor') + 1;
  }

  public function store(stdClass $data): SuratKeluar|Model
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

      'user_id' => auth()->user()->id,
    ]);
  }

  /*
  public function update(int $id, stdClass $request): SuratKeluar
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'role_id' => $request->role_id,
    ]);
  }

  public function updateWithoutPwd(int $id, stdClass $request): SuratKeluar
  {
    return tap($this->find($id))->update([
      'name' => $request->name,
      'email' => $request->email,
      'role_id' => $request->role_id,
    ]);
  }
  */
}
