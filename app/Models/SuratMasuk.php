<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SuratMasuk extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = ['date', 'nomor', 'perihal', 'asal', 'satker_id', 'desc', 'user_id'];

  public function scopeSatker_scope(Builder $builder): void
  {
    // IF USER ROLE IS SATKER
    if (auth()->check() && auth()->user()->role_id->isSatker())
      $builder->where('satker_id', auth()->user()->satker_id);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function satker(): BelongsTo
  {
    return $this->belongsTo(Satker::class);
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
