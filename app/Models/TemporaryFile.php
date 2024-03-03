<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TemporaryFile extends Model
{
  use HasFactory;

  protected $fillable = ['filename', 'folder'];

  protected static function booted()
  {
    self::deleted(function (TemporaryFile $temp) {
      Storage::disk('public')->deleteDirectory('files/tmp/' . $temp->folder);
    });
  }
}
