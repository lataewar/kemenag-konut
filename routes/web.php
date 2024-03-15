<?php

use App\Http\Controllers\CetakSuratKeluarController;
use App\Http\Controllers\CetakSuratMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\KodeInstansiController;
use App\Http\Controllers\KodeKlasifikasiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\SpesimenController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/tes.php';

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/dashboard/createnomor', [DashboardController::class, 'createNomor'])->name('dashboard.createnomor');
  Route::get('/', function () {
    return redirect()->route('dashboard');
  });

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

  // Upload and delete temporary file
  Route::post('files/processberkas', [FileUploadController::class, 'processFile']);
  Route::delete('files/revert', [FileUploadController::class, 'revert']);

  // start PROTECTED ROLE -> super admin, admin, pimpinan
  Route::group(['middleware' => ['role:super admin|admin|pimpinan']], function () {

    // ---------------------------  DEV  --------------------------- //
    Route::post('menu/dt', [MenuController::class, 'dt'])->name('menu.dt');
    Route::resource('menu', MenuController::class)->except('show');

    Route::prefix('menu/submenu/{menu}')->group(function () {
      Route::get('/', [SubMenuController::class, 'index'])->name('submenu.index');
      Route::post('/dt', [SubMenuController::class, 'dt'])->name('submenu.dt');
      Route::get('/create', [SubMenuController::class, 'create'])->name('submenu.create');
      Route::post('/store', [SubMenuController::class, 'store'])->name('submenu.store');
      Route::get('/{submenu}/edit', [SubMenuController::class, 'edit'])->name('submenu.edit');
      Route::put('/update/{submenu}', [SubMenuController::class, 'update'])->name('submenu.update');
      Route::delete('/{submenu}', [SubMenuController::class, 'destroy'])->name('submenu.destroy');
    });

    Route::post('permission/dt', [PermissionController::class, 'dt'])->name('permission.dt');
    Route::post('permission/multdelete', [PermissionController::class, 'multdelete'])->name('permission.multdelete');
    Route::resource('permission', PermissionController::class)->except('show');

    Route::post('role/dt', [RoleController::class, 'dt'])->name('role.dt');
    Route::get('role/{role}/akses', [RoleController::class, 'createAkses'])->name('role.akses');
    Route::post('role/{role}/akses', [RoleController::class, 'syncAkses'])->name('akses.sync');
    Route::get('role/{role}/permission', [RoleController::class, 'createPermission'])->name('role.permission');
    Route::post('role/{role}/permission', [RoleController::class, 'syncPermission'])->name('permission.sync');
    Route::resource('role', RoleController::class)->except('show');

    Route::post('user/dt', [UserController::class, 'dt'])->name('user.dt');
    Route::post('user/multdelete', [UserController::class, 'multdelete'])->name('user.multdelete');
    Route::resource('user', UserController::class)->except('show');

    // ---------------------------  ADMIN  --------------------------- //
    Route::post('satker/dt', [SatkerController::class, 'dt'])->name('satker.dt');
    Route::post('satker/multdelete', [SatkerController::class, 'multdelete'])->name('satker.multdelete');
    Route::resource('satker', SatkerController::class)->except('show');

    Route::get('kdins', [KodeInstansiController::class, 'index'])->name('kdins.index');
    Route::put('kdins/{kdin}', [KodeInstansiController::class, 'update'])->name('kdins.update');

    Route::post('kdkla/dt', [KodeKlasifikasiController::class, 'dt'])->name('kdkla.dt');
    Route::post('kdkla/multdelete', [KodeKlasifikasiController::class, 'multdelete'])->name('kdkla.multdelete');
    Route::resource('kdkla', KodeKlasifikasiController::class)->except('show');

    Route::post('spesimen/dt', [SpesimenController::class, 'dt'])->name('spesimen.dt');
    Route::post('spesimen/multdelete', [SpesimenController::class, 'multdelete'])->name('spesimen.multdelete');
    Route::resource('spesimen', SpesimenController::class)->except('show');
  });
  // end PROTECTED ROLE -> super admin, admin, pimpinan

  // ---------------------------  SURAT KELUAR  --------------------------- //
  Route::post('suratkeluar/dt', [SuratKeluarController::class, 'dt'])->name('suratkeluar.dt');
  Route::post('suratkeluar/multdelete', [SuratKeluarController::class, 'multdelete'])->name('suratkeluar.multdelete');
  Route::post('suratkeluar/manualcheck', [SuratKeluarController::class, 'manualcheck']);
  Route::get('suratkeluar/{id}/berkas', [SuratKeluarController::class, 'berkas'])->name('suratkeluar.berkas');
  Route::post('suratkeluar/{id}/berkas', [SuratKeluarController::class, 'storeBerkas'])->name('suratkeluar.berkas.store');
  Route::get('suratkeluar/cetak', [CetakSuratKeluarController::class, 'index'])->name('suratkeluar.cetak');
  Route::post('suratkeluar/cetak', [CetakSuratKeluarController::class, 'cetak'])->name('suratkeluar.postcetak');
  Route::resource('suratkeluar', SuratKeluarController::class);

  // ---------------------------  SURAT MASUK  --------------------------- //
  Route::post('suratmasuk/dt', [SuratMasukController::class, 'dt'])->name('suratmasuk.dt');
  Route::post('suratmasuk/multdelete', [SuratMasukController::class, 'multdelete'])->name('suratmasuk.multdelete');
  Route::get('suratmasuk/cetak', [CetakSuratMasukController::class, 'index'])->name('suratmasuk.cetak');
  Route::post('suratmasuk/cetak', [CetakSuratMasukController::class, 'cetak'])->name('suratmasuk.postcetak');
  Route::resource('suratmasuk', SuratMasukController::class);
});
