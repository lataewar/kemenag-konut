<?php

namespace App\Http\Controllers;

use App\Services\Datatables\SuratKeluarTableService;
use App\Services\KodeKlasifikasiService;
use App\Services\SpesimenService;
use App\Services\SuratKeluarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\SelectOptions;
use App\Helpers\SuratKeluarHelper;
use App\Http\Requests\SuratKeluarRequest;
use App\Models\KodeKlasifikasi;
use App\Models\Spesimen;
use App\Models\SuratKeluar;
use App\Models\TemporaryFile;
use Illuminate\View\View;

class SuratKeluarController extends Controller
{
  public function __construct(
    protected SuratKeluarService $service
  ) {
    $this->middleware('isajaxreq')->except('index');
  }

  public function index(): View
  {
    return view('suratkeluar.index');
  }

  public function dt(SuratKeluarTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table')
      return json_encode(['data' => view('suratkeluar.table')->render()]);

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    $data = [
      'klasifikasis' => app(KodeKlasifikasiService::class)->getSelectionData(),
      'spesimens' => app(SpesimenService::class)->getAll(),
    ];

    return json_encode(['data' => view('suratkeluar.create', $data)->render()]);
  }

  public function store(SuratKeluarRequest $request)//: JsonResponse
  {
    return $this->service->store((object) $request->validated());

    /*
    try {
      // Create new SuratKeluar
      $suratkeluar = SuratKeluar::create(SuratKeluarHelper::create($request));

      return response()->json(['sukses' => 'Data berhasil ditambahkan. <p class="text-primary"> Nomor Surat : ' . $suratkeluar->kombinasi . '</p>']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
    */
  }

  public function manualcheck(Request $request): JsonResponse
  {
    $from = date(date("Y", strtotime($request->data)) . '-01-01');
    $to = date($request->data);

    $nomor = SuratKeluar::whereBetween('date', [$from, $to])->max('nomor') ?? 1;
    return response()->json(['data' => $nomor]);
  }

  public function edit(SuratKeluar $suratkeluar): JsonResponse|string
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
      'pegawai' => Pegawai::get(['id', 'name']),
    ];

    return json_encode([
      'data' => view('suratkeluar.edit', [
        'data' => $suratkeluar,
      ] + $data)->render()
    ]);
  }

  public function update(SuratKeluarRequest $request, SuratKeluar $suratkeluar): JsonResponse
  {
    try {
      // Update SuratKeluar
      $suratkeluar->update(SuratKeluarHelper::edit($request, $suratkeluar->nomor));

      // Sync pegawai to suratkeluar
      $suratkeluar->pegawais()->sync($request->pegawai);

      return response()->json(['sukses' => 'Data berhasil diubah.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  public function destroy(SuratKeluar $suratkeluar): JsonResponse
  {
    try {
      // Delete SuratKeluar
      $suratkeluar->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      SuratKeluar::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }

  public function berkas(SuratKeluar $suratkeluar): JsonResponse|string
  {
    return json_encode([
      'data' => view('suratkeluar.berkas', [
        'data' => $suratkeluar,
      ])->render()
    ]);
  }

  public function storeBerkas(Request $request, SuratKeluar $suratkeluar): JsonResponse
  {
    try {
      $temporaryFile = TemporaryFile::where('folder', $request->file)->first();
      if ($temporaryFile) {
        $suratkeluar
          ->addMedia(storage_path('app/public/files/tmp/' . $request->file . '/' . $temporaryFile->filename))
          ->toMediaCollection('berkas_suratkeluar');

        rmdir(storage_path('app/public/files/tmp/' . $request->file));
        $temporaryFile->delete();
      }

      return response()->json(['sukses' => 'Berkas berhasil diunggah.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string) $th]);
    }
  }
}
