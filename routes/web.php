<?php

use App\Http\Controllers\CetakSuratKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\KodeInstansiController;
use App\Http\Controllers\KodeKlasifikasiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpesimenController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\SuratKeluarController;
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

  // Upload and delete temporary file
  Route::post('files/processberkas', [FileUploadController::class, 'processFile']);
  Route::delete('files/revert', [FileUploadController::class, 'revert']);

  Route::post('user/dt', [UserController::class, 'dt'])->name('user.dt');
  Route::post('user/multdelete', [UserController::class, 'multdelete'])->name('user.multdelete');
  Route::resource('user', UserController::class)->except('show');

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

  Route::post('role/dt', [RoleController::class, 'dt'])->name('role.dt');
  Route::get('role/{role}/akses', [RoleController::class, 'createAkses'])->name('role.akses');
  Route::post('role/{role}/akses', [RoleController::class, 'syncAkses'])->name('akses.sync');
  Route::resource('role', RoleController::class)->except('show');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

  Route::post('kdkla/dt', [KodeKlasifikasiController::class, 'dt'])->name('kdkla.dt');
  Route::post('kdkla/multdelete', [KodeKlasifikasiController::class, 'multdelete'])->name('kdkla.multdelete');
  Route::resource('kdkla', KodeKlasifikasiController::class)->except('show');

  Route::post('spesimen/dt', [SpesimenController::class, 'dt'])->name('spesimen.dt');
  Route::post('spesimen/multdelete', [SpesimenController::class, 'multdelete'])->name('spesimen.multdelete');
  Route::resource('spesimen', SpesimenController::class)->except('show');

  Route::get('kdins', [KodeInstansiController::class, 'index'])->name('kdins.index');
  Route::put('kdins/{kdin}', [KodeInstansiController::class, 'update'])->name('kdins.update');

  Route::post('suratkeluar/dt', [SuratKeluarController::class, 'dt'])->name('suratkeluar.dt');
  Route::post('suratkeluar/multdelete', [SuratKeluarController::class, 'multdelete'])->name('suratkeluar.multdelete');
  Route::post('suratkeluar/manualcheck', [SuratKeluarController::class, 'manualcheck']);
  Route::get('suratkeluar/{id}/berkas', [SuratKeluarController::class, 'berkas'])->name('suratkeluar.berkas');
  Route::post('suratkeluar/{id}/berkas', [SuratKeluarController::class, 'storeBerkas'])->name('suratkeluar.berkas.store');
  Route::get('suratkeluar/cetak', [CetakSuratKeluarController::class, 'index'])->name('suratkeluar.cetak');
  Route::post('suratkeluar/cetak', [CetakSuratKeluarController::class, 'cetak'])->name('suratkeluar.postcetak');
  Route::resource('suratkeluar', SuratKeluarController::class);
});
