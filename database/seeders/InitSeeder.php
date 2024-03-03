<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\SubMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Role::create([
      'id' => 1,
      'name' => 'sup_admin',
      'desc' => 'Super Administrator',
    ]);

    Menu::create([
      'id' => 1,
      'name' => 'DEV',
      'icon' => 'Code/Code.svg',
      'desc' => 'Menu Development',
      'has_submenu' => 1,
    ]);

    SubMenu::insert([
      [
        'id' => 1,
        'menu_id' => 1,
        'name' => 'Menu',
        'route' => 'menu.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 2,
        'menu_id' => 1,
        'name' => 'Role',
        'route' => 'role.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 3,
        'menu_id' => 1,
        'name' => 'User',
        'route' => 'user.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    DB::table('menu_role')->insert(['menu_id' => 1, 'role_id' => 1]);

    \App\Models\User::factory()->create([
      'id' => 1,
      'name' => 'Super Admin',
      'email' => 'supadmin@admin.com',
      'password' => Hash::make('zzzzzzzz'),
      'role_id' => 1,
    ]);
  }
}
