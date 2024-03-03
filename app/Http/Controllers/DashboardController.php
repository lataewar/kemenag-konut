<?php

namespace App\Http\Controllers;

use App\Helpers\SelectOptions;
use App\Models\KodeKlasifikasi;
use App\Models\Spesimen;
use App\Models\SuratKeluar;

class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->except('index');
  }

  public function index()
  {
    return view('dashboard.index', [
      // 'pegawai' => Pegawai::count(),
      'suratkeluar' => SuratKeluar::whereYear('date', date("Y"))->count(),
      'lastnomor' => SuratKeluar::whereYear('date', date("Y"))->max('nomor'),
    ]);
  }

  public function createNomor()
  {
    $klasArr = [];
    foreach (KodeKlasifikasi::get(['id', 'kode', 'name', 'desc']) as $item) {
      array_push($klasArr, [
        'id' => $item->id,
        'name' => $item->kode . ', ' . $item->name . ', ' . $item->desc,
      ]);
    }

    $data = [
      'options' => SelectOptions::getSurat(),
      'klasifikasis' => collect($klasArr),
      'spesimens' => Spesimen::get(['id', 'name']),
    ];

    return json_encode([
      'data' => view('dashboard.createnomor', $data)->render()
    ]);
  }
}
