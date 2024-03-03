<?php

namespace Database\Seeders;

use App\Models\KodeInstansi;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Menu::create([
      'id' => 2,
      'name' => 'Admin',
      'icon' => 'Code/Settings4.svg',
      'desc' => 'Menu Admin',
      'has_submenu' => 1,
    ]);

    SubMenu::insert([
      [
        'id' => 4,
        'menu_id' => 2,
        'name' => 'Kode Instansi',
        'route' => 'kdins.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 5,
        'menu_id' => 2,
        'name' => 'Kode Klasifikasi',
        'route' => 'kdkla.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 6,
        'menu_id' => 2,
        'name' => 'Pejabat Spesimen',
        'route' => 'spesimen.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    Menu::create([
      'id' => 3,
      'name' => 'Surat Keluar',
      'route' => 'suratkeluar.index',
      'icon' => 'Code/Settings4.svg',
      'desc' => 'Menu Surat Keluar',
      'has_submenu' => 0,
    ]);

    DB::table('menu_role')->insert([
      ['menu_id' => 2, 'role_id' => 1],
      ['menu_id' => 3, 'role_id' => 1],
    ]);
  }
}
