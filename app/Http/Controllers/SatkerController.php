<?php

namespace App\Http\Controllers;

use App\Http\Requests\SatkerRequest;
use App\Services\Datatables\SatkerTableService;
use App\Services\SatkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SatkerController extends Controller
{
  public function __construct(
    protected SatkerService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create satker')->only(['create', 'store']);
    $this->middleware('permission:read satker')->only(['index', 'dt']);
    $this->middleware('permission:update satker')->only(['edit', 'update']);
    $this->middleware('permission:delete satker')->only(['destroy']);
    $this->middleware('permission:multidelete satker')->only(['multdelete']);
  }

  public function index(): View
  {
    return view('satker.index');
  }

  public function dt(SatkerTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('satker.table')->render()
      ]);
    }

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    return json_encode([
      'data' => view('satker.create')->render()
    ]);
  }

  public function store(SatkerRequest $request): JsonResponse
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($satker): JsonResponse|string
  {
    return json_encode([
      'data' => view('satker.edit', [
        'data' => $this->service->find($satker),
      ])->render()
    ]);
  }

  public function update(SatkerRequest $request, $satker): JsonResponse
  {
    if ($this->service->update($satker, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($satker): JsonResponse
  {
    if ($this->service->delete($satker))
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
