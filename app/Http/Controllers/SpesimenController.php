<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpesimenRequest;
use App\Services\Datatables\SpesimenTableService;
use App\Services\SpesimenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpesimenController extends Controller
{
  public function __construct(
    protected SpesimenService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create spesimen')->only(['create', 'store']);
    $this->middleware('permission:read spesimen')->only(['index', 'dt']);
    $this->middleware('permission:update spesimen')->only(['edit', 'update']);
    $this->middleware('permission:delete spesimen')->only(['destroy']);
    $this->middleware('permission:multidelete spesimen')->only(['multdelete']);
  }

  public function index(): View
  {
    return view('spesimen.index');
  }

  public function dt(SpesimenTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table')
      return json_encode(['data' => view('spesimen.table')->render()]);

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    return json_encode(['data' => view('spesimen.create')->render()]);
  }

  public function store(SpesimenRequest $request): JsonResponse
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function edit($spesiman): JsonResponse|string
  {
    return json_encode([
      'data' => view('spesimen.edit', [
        'data' => $this->service->find($spesiman),
      ])->render()
    ]);
  }

  public function update(SpesimenRequest $request, $spesiman): JsonResponse
  {
    if ($this->service->update($spesiman, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($spesiman): JsonResponse
  {
    if ($this->service->delete($spesiman))
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
