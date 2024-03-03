<?php

namespace Database\Seeders;

use App\Models\KodeInstansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KodeInstansiSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    KodeInstansi::insert([
      'id' => 1,
      'kode' => 'Kk.24.11',
      'name' => 'Kantor Kemenag Kab. Konut',
      'desc' => 'Kantor Kementerian Agama Kabupaten Konawe Utara',
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }
}
