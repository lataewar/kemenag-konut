<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\Datatables\PermissionTableService;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
  public function __construct(
    protected PermissionService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create permission')->only(['create', 'store']);
    $this->middleware('permission:read permission')->only(['index', 'dt']);
    $this->middleware('permission:update permission')->only(['edit', 'update']);
    $this->middleware('permission:delete permission')->only(['destroy']);
    $this->middleware('permission:multidelete permission')->only(['multdelete']);
  }

  public function index(): View
  {
    return view('permission.index');
  }

  public function dt(PermissionTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('permission.table')->render()
      ]);
    }

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    return json_encode([
      'data' => view('permission.create')->render()
    ]);
  }

  public function store(RoleRequest $request): JsonResponse
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($permission): JsonResponse|string
  {
    return json_encode([
      'data' => view('permission.edit', [
        'data' => $this->service->find($permission),
      ])->render()
    ]);
  }

  public function update(RoleRequest $request, $permission): JsonResponse
  {
    if ($this->service->update($permission, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($permission): JsonResponse
  {
    if ($this->service->delete($permission))
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
