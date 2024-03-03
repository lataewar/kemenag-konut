<?php

namespace App\Models;

use App\Enums\KategoriSuratEnum;
use App\Enums\SifatSuratEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SuratKeluar extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = ['nomor', 'kombinasi', 'kategori', 'date', 'klasifikasi_id', 'sifat', 'perihal', 'tujuan', 'spesimen_id', 'asal', 'is_otomatis', 'user_id', 'desc'];

  protected $casts = [
    'kategori' => KategoriSuratEnum::class,
    'sifat' => SifatSuratEnum::class,
  ];

  public function klasifikasi()
  {
    return $this->belongsTo(KodeKlasifikasi::class, 'klasifikasi_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function registerMediaCollections(): void
  {
    $this
      ->addMediaCollection('berkas_suratkeluar')
      ->singleFile()
      ->useDisk('public')
      ->useFallbackUrl(asset('/assets/media/users/blank.png'))
      ->useFallbackPath(asset('/assets/media/users/blank.png'));
  }
}
