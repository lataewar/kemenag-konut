<?php

namespace Database\Factories;

use App\Models\Backup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backup>
 */
class BackupFactory extends Factory
{
  protected $model = Backup::class;

  public function definition(): array
  {
    return [
      'name' => $this->faker->randomElement(['Surat Masuk', 'Surat Keluar']),
      'user_id' => 1,
    ];
  }
}
