<?php

namespace App\Models;

use App\Enums\KategoriSuratEnum;
use App\Enums\SifatSuratEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SuratKeluar extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = ['nomor', 'sisipan', 'kombinasi', 'full_nomor', 'kategori', 'date', 'klasifikasi_id', 'sifat', 'perihal', 'tujuan', 'spesimen_id', 'asal', 'is_otomatis', 'user_id', 'desc'];

  protected $casts = [
    'kategori' => KategoriSuratEnum::class,
    'sifat' => SifatSuratEnum::class,
  ];

  public function klasifikasi(): BelongsTo
  {
    return $this->belongsTo(KodeKlasifikasi::class, 'klasifikasi_id', 'id');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function registerMediaCollections(): void
  {
    $this
      ->addMediaCollection('default')
      ->singleFile()
      ->useFallbackUrl(asset('/assets/media/users/blank.png'))
      ->useFallbackPath(asset('/assets/media/users/blank.png'));
  }
}
