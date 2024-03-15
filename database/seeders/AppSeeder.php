<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Satker;
use App\Models\SubMenu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        'id' => 5,
        'menu_id' => 2,
        'name' => 'Satuan Kerja',
        'route' => 'satker.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 6,
        'menu_id' => 2,
        'name' => 'Kode Instansi',
        'route' => 'kdins.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 7,
        'menu_id' => 2,
        'name' => 'Kode Klasifikasi',
        'route' => 'kdkla.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 8,
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

    Menu::create([
      'id' => 4,
      'name' => 'Surat Masuk',
      'route' => 'suratmasuk.index',
      'icon' => 'Code/Settings4.svg',
      'desc' => 'Menu Surat Masuk',
      'has_submenu' => 0,
    ]);

    DB::table('menu_role')->insert([
      ['menu_id' => 2, 'role_id' => 1],
      ['menu_id' => 3, 'role_id' => 1],
      ['menu_id' => 4, 'role_id' => 1],
    ]);

    // ------------------------------  ------------------------------ //

    Satker::insert([
      [
        'id' => 1,
        'name' => 'Sekertariat Jenderal',
        'kode' => '-',
        'desc' => 'Sekertariat Jenderal',
      ],
      [
        'id' => 2,
        'name' => 'Bimbingan Masyarakat Islam',
        'kode' => '-',
        'desc' => 'Bimbingan Masyarakat Islam',
      ],
      [
        'id' => 3,
        'name' => 'Pendidikan Islam',
        'kode' => '-',
        'desc' => 'Pendidikan Islam',
      ],
      [
        'id' => 4,
        'name' => 'Penyelenggara Haji dan Umrah',
        'kode' => '-',
        'desc' => 'Penyelenggara Haji dan Umrah',
      ],
      [
        'id' => 5,
        'name' => 'Penyelenggara Syariah Zakat dan Wakaf',
        'kode' => '-',
        'desc' => 'Penyelenggara Syariah Zakat dan Wakaf',
      ],
    ]);

    // ------------------------------  ------------------------------ //

    $permissions = ['create satker', 'read satker', 'update satker', 'delete satker', 'multidelete satker'];
    $permissions = [...$permissions, ...['read instansi', 'update instansi']];
    $permissions = [...$permissions, ...['create klasifikasi', 'read klasifikasi', 'update klasifikasi', 'delete klasifikasi', 'multidelete klasifikasi']];
    $permissions = [...$permissions, ...['create spesimen', 'read spesimen', 'update spesimen', 'delete spesimen', 'multidelete spesimen']];
    $permissions = [...$permissions, ...['create nomor', 'read nomor', 'update nomor', 'delete nomor', 'multidelete nomor', 'print nomor']];
    $permissions = [...$permissions, ...['create surat_masuk', 'read surat_masuk', 'update surat_masuk', 'delete surat_masuk', 'multidelete surat_masuk', 'print surat_masuk']];

    foreach ($permissions as $item) {
      Permission::create(['name' => $item]);
    }

    $role = Role::findByName('super admin');
    $role->givePermissionTo($permissions);

    // ------------------------------  ------------------------------ //

    $adminPermissions = [...['read menu', 'read permission', 'read role', 'create user', 'read user', 'update user', 'delete user', 'multidelete user'], ...$permissions];
    \App\Models\Role::create([
      'id' => 2,
      'name' => 'admin',
      'guard_name' => 'web',
      'desc' => 'Administrator',
    ]);
    $role = Role::findByName('admin');
    $role->givePermissionTo($adminPermissions);

    \App\Models\Role::create([
      'id' => 3,
      'name' => 'pimpinan',
      'guard_name' => 'web',
      'desc' => 'Pimpinan',
    ]);
    $role = Role::findByName('pimpinan');
    $role->givePermissionTo($adminPermissions);

    \App\Models\Role::create([
      'id' => 4,
      'name' => 'satker',
      'guard_name' => 'web',
      'desc' => 'Satuan Kerja',
    ]);
    $role = Role::findByName('satker');
    $role->givePermissionTo(['create nomor', 'read nomor', 'update nomor', 'delete nomor', 'print nomor', 'create surat_masuk', 'read surat_masuk', 'update surat_masuk', 'delete surat_masuk', 'multidelete surat_masuk', 'print surat_masuk']);

    // ------------------------------  ------------------------------ //

    DB::table('menu_role')->insert([
      ['menu_id' => 1, 'role_id' => 2],
      ['menu_id' => 2, 'role_id' => 2],
      ['menu_id' => 3, 'role_id' => 2],
      ['menu_id' => 4, 'role_id' => 2],

      ['menu_id' => 1, 'role_id' => 3],
      ['menu_id' => 2, 'role_id' => 3],
      ['menu_id' => 3, 'role_id' => 3],
      ['menu_id' => 4, 'role_id' => 3],

      ['menu_id' => 3, 'role_id' => 4],
      ['menu_id' => 4, 'role_id' => 4],
    ]);

    // ------------------------------  ------------------------------ //

    $admin = User::factory()->create([
      'id' => 2,
      'name' => 'Administrator',
      'email' => 'admin@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 2,
    ]);
    $admin->assignRole('admin');

    $pimpinan = User::factory()->create([
      'id' => 3,
      'name' => 'Kepala Kantor',
      'email' => 'pimpinan@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 3,
    ]);
    $pimpinan->assignRole('pimpinan');

    $satker = User::factory()->create([
      'id' => 4,
      'name' => 'Sekertariat Jenderal',
      'email' => 'sekjen@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 1,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 5,
      'name' => 'Bimbingan Masyarakat Islam',
      'email' => 'bimasislam@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 2,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 6,
      'name' => 'Pendidikan Islam',
      'email' => 'pendis@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 3,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 7,
      'name' => 'Penyelenggara Haji dan Umrah',
      'email' => 'phu@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 4,
    ]);
    $satker->assignRole('satker');
    $satker = User::factory()->create([
      'id' => 8,
      'name' => 'Penyelenggara Syariah Zakat dan Wakaf',
      'email' => 'zawa@admin.com',
      'password' => Hash::make('12345678'),
      'role_id' => 4,
      'satker_id' => 5,
    ]);
    $satker->assignRole('satker');

  }
}
