<?php

use App\Enums\UserRole;
use App\Models\SuratKeluar;
use App\Models\User;
use App\Repositories\SuratKeluarRepository;
use App\Services\SuratKeluarService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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

  // $data = DB::table('surat_keluars')
  $data = SuratKeluar::query()
    ->with('media')
    ->get();

  $json = json_encode($data);
  // $fileName = time() . '_datafile.json';
  $fileName = 'datafile.json';

  $store = Storage::put('backups/' . $fileName, $json);

  return $store;

});

Route::get('tes2', function () {
  $file = Storage::get('backups/datafile.json');
  $json = json_decode($file, true);

  // $data = collect($json);
  $dirs = [];

  foreach ($json as $item) {
    $item = (object) $item;
    $suratkeluar = SuratKeluar::create([
      'date' => $item->date,
      'nomor' => $item->nomor,
      'kombinasi' => $item->kombinasi,
      'sisipan' => $item->sisipan,
      'full_nomor' => $item->full_nomor,
      'is_otomatis' => $item->is_otomatis,
      'kategori' => $item->kategori,
      'sifat' => $item->sifat,
      'klasifikasi_id' => $item->klasifikasi_id,
      'perihal' => $item->perihal,
      'asal' => $item->asal,
      'tujuan' => $item->tujuan,
      'spesimen_id' => $item->spesimen_id,
      'desc' => $item->desc,
      'user_id' => $item->user_id,
      'created_at' => Carbon::parse($item->created_at),
      'updated_at' => Carbon::parse($item->updated_at),
    ]);

    if ($item->media) {
      $media = (object) $item->media[0];
      // dump($media);
      DB::insert('INSERT INTO media (model_type, model_id, uuid, collection_name, name, file_name, mime_type, disk, conversions_disk, size, manipulations, custom_properties, generated_conversions, responsive_images, order_column, created_at, updated_at)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [
          $media->model_type,
          $suratkeluar->id,
          $media->uuid,
          $media->collection_name,
          $media->name,
          $media->file_name,
          $media->mime_type,
          $media->disk,
          $media->conversions_disk,
          $media->size,
          json_encode($media->manipulations),
          json_encode($media->custom_properties),
          json_encode($media->generated_conversions),
          json_encode($media->responsive_images),
          $media->order_column,
          Carbon::parse($media->created_at),
          Carbon::parse($media->updated_at)
        ]
      );

      array_push($dirs, $media->uuid);
    }

  }

  dump($dirs);

  // return $data;
});

Route::get('tes3', function () {

  $dirs = [
    "b6d5d03d-0888-464a-8f12-74293ed7ecb4",
    "fc7eec5f-94ee-4be1-b899-d4e6d55fb31f",
    "fffb4969-c34e-4fd0-b450-fa3e5bb02a45",
    "9446e794-53b2-42a5-b859-d0cc2106f003",
  ];

  $zip_file = 'invoices.zip';
  $zip = new \ZipArchive();
  $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

  foreach ($dirs as $dir) {
    $path = storage_path('app/public/' . $dir);
    // dd($path);
    $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
    foreach ($files as $name => $file) {
      // We're skipping all subfolders
      if (!$file->isDir()) {
        $filePath = $file->getRealPath();

        // extracting filename with substr/strlen
        $relativePath = $dir . '/' . substr($filePath, strlen($path) + 1);

        $zip->addFile($filePath, $relativePath);
      }
    }
  }
  $zip->close();
});
