<?php

namespace App\Helpers;

class SelectOptions
{
  private static $jenkel = [
    ['id' => 'L', 'name' => 'Laki-laki'],
    ['id' => 'P', 'name' => 'Perempuan'],
  ];

  private static $agama = [
    ['id' => 'Islam', 'name' => 'Islam'],
    ['id' => 'Protestan', 'name' => 'Protestan'],
    ['id' => 'Katolik', 'name' => 'Katolik'],
    ['id' => 'Hindu', 'name' => 'Hindu'],
    ['id' => 'Buddha', 'name' => 'Buddha'],
    ['id' => 'Khonghucu', 'name' => 'Khonghucu'],
  ];

  private static $statuskawin = [
    ['id' => 'Y', 'name' => 'Kawin'],
    ['id' => 'N', 'name' => 'Tidak'],
  ];

  private static $statuspegawai = [
    ['id' => 'Y', 'name' => 'PNS'],
    ['id' => 'N', 'name' => 'Non PNS'],
  ];

  private static $golpangkat = [
    ['id' => 'I/a Juru Muda', 'name' => 'I/a Juru Muda'],
    ['id' => 'I/b Juru Muda Tingkat I', 'name' => 'I/b Juru Muda Tingkat I'],
    ['id' => 'I/c Juru', 'name' => 'I/c Juru'],
    ['id' => 'I/d Juru Tingkat I', 'name' => 'I/d Juru Tingkat I'],
    ['id' => 'II/a Pengatur Muda', 'name' => 'II/a Pengatur Muda'],
    ['id' => 'II/b Pengatur Muda Tingkat I', 'name' => 'II/b Pengatur Muda Tingkat I'],
    ['id' => 'II/c Pengatur', 'name' => 'II/c Pengatur'],
    ['id' => 'II/d Pengatur Tingkat I', 'name' => 'II/d Pengatur Tingkat I'],
    ['id' => 'III/a Penata Muda', 'name' => 'III/a Penata Muda'],
    ['id' => 'III/b Penata Muda Tingkat I', 'name' => 'III/b Penata Muda Tingkat I'],
    ['id' => 'III/c Penata', 'name' => 'III/c Penata'],
    ['id' => 'III/d Penata Tingkat I', 'name' => 'III/d Penata Tingkat I'],
    ['id' => 'IV/a Pembina', 'name' => 'IV/a Pembina'],
    ['id' => 'IV/b Pembina Tingkat I', 'name' => 'IV/b Pembina Tingkat I'],
    ['id' => 'IV/c Pembina Utama Muda', 'name' => 'IV/c Pembina Utama Muda'],
    ['id' => 'IV/d Pembina Utama Madya', 'name' => 'IV/d Pembina Utama Madya'],
    ['id' => 'IV/e Pembina Utama', 'name' => 'IV/e Pembina Utama'],
  ];

  private static $pendterakhir = [
    ['id' => 'Sekolah Dasar', 'name' => 'Sekolah Dasar'],
    ['id' => 'SLTP', 'name' => 'SLTP'],
    ['id' => 'SLTP Kejuruan', 'name' => 'SLTP Kejuruan'],
    ['id' => 'SLTA', 'name' => 'SLTA'],
    ['id' => 'SLTA Kejuruan', 'name' => 'SLTA Kejuruan'],
    ['id' => 'SLTA Keguruan', 'name' => 'SLTA Keguruan'],
    ['id' => 'Diploma I', 'name' => 'Diploma I'],
    ['id' => 'Diploma II', 'name' => 'Diploma II'],
    ['id' => 'Diploma III/Sarjana Muda', 'name' => 'Diploma III/Sarjana Muda'],
    ['id' => 'Diploma IV', 'name' => 'Diploma IV'],
    ['id' => 'S-1/Sarjana', 'name' => 'S-1/Sarjana'],
    ['id' => 'S-2', 'name' => 'S-2'],
    ['id' => 'S-3/Doktor', 'name' => 'S-3/Doktor'],
  ];

  private static $metodepenomoran = [
    ['id' => '1', 'name' => 'Otomatis'],
    ['id' => '0', 'name' => 'Manual'],
  ];

  private static $sifatsurat = [
    ['id' => '0', 'name' => '-'],
    ['id' => '1', 'name' => 'Biasa'],
    ['id' => '2', 'name' => 'Penting'],
  ];

  private static $kategorisurat = [
    ['id' => '1', 'name' => 'Surat Keluar'],
    ['id' => '2', 'name' => 'Surat Keputusan'],
  ];

  private static $isDebit = [
    ['id' => '1', 'name' => 'Pemasukan (Debit)'],
    ['id' => '0', 'name' => 'Pengeluaran (Kredit)'],
  ];

  public static function getAll()
  {
    return [
      'jenkel' => self::$jenkel,
      'agama' => self::$agama,
      'statuskawin' => self::$statuskawin,
      'statuspegawai' => self::$statuspegawai,
      'golpangkat' => self::$golpangkat,
      'pendterakhir' => self::$pendterakhir,
    ];
  }

  public static function getSurat()
  {
    return [
      'metodepenomoran' => self::$metodepenomoran,
      'sifatsurat' => self::$sifatsurat,
      'kategorisurat' => self::$kategorisurat,
    ];
  }

  public static function getZakat()
  {
    return [
      'isDebit' => self::$isDebit,
    ];
  }
}
