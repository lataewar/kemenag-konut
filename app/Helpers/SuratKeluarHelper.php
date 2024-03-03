<?php

namespace App\Helpers;

use App\Models\KodeInstansi;
use App\Models\KodeKlasifikasi;
use App\Models\SuratKeluar;
use Carbon\Carbon;

class SuratKeluarHelper
{
  private static function initData($request)
  {
    return [
      'date' => $request->date,
      'kategori' => $request->kategori,
      'sifat' => $request->sifat,
      'klasifikasi_id' => $request->klasifikasi_id,
      'perihal' => $request->perihal,
      'asal' => $request->asal,
      'tujuan' => $request->tujuan,
      'pejabatspesimen_id' => $request->spesimen_id,
      'desc' => $request->desc,
    ];
  }

  private static function getKombinasi($request, $nomor)
  {
    $kis = KodeInstansi::find(1);
    $kkl = KodeKlasifikasi::find($request->klasifikasi_id)->kode;
    $tgl = Carbon::createFromFormat('Y-m-d', $request->date)->isoFormat('/MM/Y');
    $kombinasi = $nomor . '/' . $kis->kode . '/' . $kkl . $tgl;
    $kombinasi = ($request->sifat == 1) ? 'B-' . $kombinasi : $kombinasi;

    return [
      'kombinasi' => $kombinasi,
      'instansi_id' => $kis->id,
    ];
  }

  public static function create($request)
  {
    $data = self::initData($request);

    // Jika Menggunakan Metode Manual
    if (!$request->metode)
      $data += ['nomor' => $request->nomor];
    // Jika Menggunakan Metode Otomatis
    else {
      $nomor = SuratKeluar::whereYear('date', date('Y'))->max('nomor') + 1;
      $data += ['nomor' => $nomor];
    }

    $data += self::getKombinasi($request, $data['nomor']) + ['user_id' => auth()->user()->id];

    return $data;
  }

  public static function edit($request, $nomor)
  {
    $data = self::initData($request);
    $data += self::getKombinasi($request, $nomor);

    return $data;
  }
}
