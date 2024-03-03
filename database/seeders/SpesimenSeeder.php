<?php

namespace Database\Seeders;

use App\Models\Spesimen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpesimenSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Spesimen::insert([
      [
        "name" => "Kepala Kantor",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        "name" => "Kepala Sub Bagian Tata Usaha",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        "name" => "Kepala Seksi Pendis",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        "name" => "Kepala Seksi Bimas Islam",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        "name" => "Penyelenggara Haji dan Umrah",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        "name" => "Penyelenggara Katolik",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        "name" => "Penyelenggara Hindu",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        "name" => "PPK",
        "desc" => null,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
