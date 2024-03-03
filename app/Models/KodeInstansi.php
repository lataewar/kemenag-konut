<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeInstansi extends Model
{
  use HasFactory;

  protected $fillable = ['kode', 'name', 'desc'];

  public function suratKeluars()
  {
    return $this->hasMany(SuratKeluar::class, 'instansi_id');
  }
}
