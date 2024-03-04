<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratKeluarEditRequest;
use App\Services\Datatables\SuratKeluarTableService;
use App\Services\KodeKlasifikasiService;
use App\Services\SpesimenService;
use App\Services\SuratKeluarService;
use Illuminate\Database\QueryException;
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

  public function store(SuratKeluarRequest $request): JsonResponse
  {
    try {
      $suratkeluar = $this->service->store((object) $request->validated());
      return response()->json(['sukses' => 'Data berhasil ditambahkan. <p class="text-primary"> Nomor Surat : ' . $suratkeluar->full_nomor . '</p>']);

    } catch (QueryException $e) {
      $errorCode = $e->errorInfo[1];
      if ($errorCode == 1062) {
        // we have a duplicate entry problem
        return response()->json(['gagal' => 'Kombinasi nomor surat sudah ada sebelumnya.']);
      }
      return response()->json(['gagal' => 'Data gagal ditambahkan.']);
    }
  }

  public function manualcheck(Request $request): JsonResponse
  {
    return $this->service->check((object) $request->all());
  }

  public function edit($suratkeluar): JsonResponse|string
  {
    $data = [
      'klasifikasis' => app(KodeKlasifikasiService::class)->getSelectionData(),
      'spesimens' => app(SpesimenService::class)->getAll(),
      'data' => $this->service->find($suratkeluar),
    ];

    return json_encode(['data' => view('suratkeluar.edit', $data)->render()]);
  }

  public function update(SuratKeluarEditRequest $request, $suratkeluar): JsonResponse
  {
    try {
      $suratkeluar = $this->service->update($suratkeluar, (object) $request->validated());
      return response()->json(['sukses' => 'Data berhasil diubah. <p class="text-primary"> Nomor Surat : ' . $suratkeluar->full_nomor . '</p>']);

    } catch (QueryException $e) {
      $errorCode = $e->errorInfo[1];
      if ($errorCode == 1062) {
        // we have a duplicate entry problem
        return response()->json(['gagal' => 'Kombinasi nomor surat sudah ada sebelumnya.']);
      }
      return response()->json(['gagal' => 'Data gagal diubah.']);
    }
  }

  public function destroy($suratkeluar): JsonResponse
  {
    if ($this->service->delete($suratkeluar))
      return response()->json(['sukses' => 'Data berhasil dihapus.']);

    return response()->json(['gagal' => 'Data gagal dihapus.']);
  }

  public function multdelete(Request $request): JsonResponse
  {
    if ($this->service->multipleDelete($request->post('ids')))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
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
