<?php

namespace App\Http\Controllers;

use App\Services\Datatables\KodeKlasifikasiTableService;
use App\Services\KodeKlasifikasiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\KodeKlasifikasiRequest;
use Illuminate\View\View;

class KodeKlasifikasiController extends Controller
{
  public function __construct(
    protected KodeKlasifikasiService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create klasifikasi')->only(['create', 'store']);
    $this->middleware('permission:read klasifikasi')->only(['index', 'dt']);
    $this->middleware('permission:update klasifikasi')->only(['edit', 'update']);
    $this->middleware('permission:delete klasifikasi')->only(['destroy']);
    $this->middleware('permission:multidelete klasifikasi')->only(['multdelete']);
  }

  public function index(): View
  {
    return view('kd_klasifikasi.index');
  }

  public function dt(KodeKlasifikasiTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table')
      return json_encode(['data' => view('kd_klasifikasi.table')->render()]);

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    return json_encode([
      'data' => view('kd_klasifikasi.create')->render()
    ]);
  }

  public function store(KodeKlasifikasiRequest $request): JsonResponse
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($kdkla): JsonResponse|string
  {
    return json_encode([
      'data' => view('kd_klasifikasi.edit', [
        'data' => $this->service->find($kdkla),
      ])->render()
    ]);
  }

  public function update(KodeKlasifikasiRequest $request, $kdkla): JsonResponse
  {
    if ($this->service->update($kdkla, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($kdkla): JsonResponse
  {
    if ($this->service->delete($kdkla))
      return response()->json(['sukses' => 'Data berhasil dihapus.']);

    return response()->json(['gagal' => 'Data gagal dihapus.']);
  }

  public function multdelete(Request $request): JsonResponse
  {
    if ($this->service->multipleDelete($request->post('ids')))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }
}
