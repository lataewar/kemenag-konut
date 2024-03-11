<?php

use App\Enums\UserRole;
use App\Models\User;
use App\Repositories\SuratKeluarRepository;
use App\Services\SuratKeluarService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('tes', function () {
  /*
  // $date = Carbon::createFromFormat('Y-m-d', '2024-03-02');
  $date = Carbon::parse('2024-03-03')->startOfDay();
  $sy = Carbon::parse('2024-03-03')->startOfYear();
  $today = Carbon::now()->startOfDay();
  // $today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
  // $today = Carbon::now()->format('Y-m-d');

  dump($date);
  dump('sy : ' . $sy);
  dump('today : ' . $today);


  dump($date->eq($today));
  */

  // $data = app(SuratKeluarRepository::class)->table()->get();

  // return $data;

  // $role = Role::create(['name' => 'writer']);
  // $permission = Permission::create(['name' => 'edit articles']);

  // $user = User::find(1);
  // $user->assignRole('super admin');

  // dump(auth()->user()->satker_id);

  return app(SuratKeluarService::class)->find(19);
  return app(SuratKeluarRepository::class)->table()->get();

  echo auth()->user()->role_id->isSatker();
});
