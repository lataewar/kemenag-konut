<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratMasukRequest;
use App\Services\Datatables\SuratMasukTableService;
use App\Services\SatkerService;
use App\Services\SuratMasukService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuratMasukController extends Controller
{
  public function __construct(
    protected SuratMasukService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create surat_masuk')->only(['create', 'store']);
    $this->middleware('permission:read surat_masuk')->only(['index', 'dt']);
    $this->middleware('permission:update surat_masuk')->only(['edit', 'update']);
    $this->middleware('permission:delete surat_masuk')->only(['destroy']);
    $this->middleware('permission:multidelete surat_masuk')->only(['multdelete']);
  }

  public function index(): View
  {
    return view('suratmasuk.index');
  }

  public function dt(SuratMasukTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table')
      return json_encode(['data' => view('suratmasuk.table')->render()]);

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    return json_encode([
      'data' => view('suratmasuk.create', [
        'satkers' => app(SatkerService::class)->all(),
      ])->render()
    ]);
  }
  public function store(SuratMasukRequest $request): JsonResponse
  {
    if ($this->service->store((object) $request->validated()))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($suratmasuk): JsonResponse|string
  {
    return json_encode([
      'data' => view('suratmasuk.edit', [
        'data' => $this->service->find($suratmasuk),
        'satkers' => app(SatkerService::class)->all(),
      ])->render()
    ]);
  }

  public function update(SuratMasukRequest $request, $suratmasuk): JsonResponse
  {
    if ($this->service->update($suratmasuk, (object) $request->validated()))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($suratmasuk): JsonResponse
  {
    if ($this->service->delete($suratmasuk))
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
