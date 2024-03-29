<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\Datatables\RoleTableService;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
  public function __construct(
    protected RoleService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create role')->only(['create', 'store']);
    $this->middleware('permission:read role')->only(['index', 'dt', 'createAkses', 'createPermission']);
    $this->middleware('permission:setakses role')->only(['syncAkses']);
    $this->middleware('permission:setpermission role')->only(['syncPermission']);
    $this->middleware('permission:update role')->only(['edit', 'update']);
    $this->middleware('permission:delete role')->only(['destroy']);
  }

  public function index(): View
  {
    return view('role.index');
  }

  public function dt(RoleTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('role.table')->render()
      ]);
    }

    return $datatable->table();
  }

  public function createAkses($role): JsonResponse|string
  {
    return json_encode([
      'data' => view('role.akses', $this->service->createAkses($role))->render()
    ]);
  }

  public function syncAkses($role, Request $request): JsonResponse
  {
    if ($this->service->syncAkses($role, $request->menus ?? []))
      return response()->json(['sukses' => 'berhasil mengubah hak akses.']);

    return response()->json(['gagal' => 'gagal mengubah hak akses.']);
  }

  public function createPermission($role): JsonResponse|string
  {
    return json_encode([
      'data' => view('role.izin', $this->service->createPermission($role))->render()
    ]);
  }

  public function syncPermission($role, Request $request): JsonResponse
  {
    if ($this->service->syncPermission($role, $request->permissions ?? []))
      return response()->json(['sukses' => 'berhasil mengubah izin.']);

    return response()->json(['gagal' => 'gagal mengubah izin.']);
  }

  public function create(): JsonResponse|string
  {
    return json_encode([
      'data' => view('role.create')->render()
    ]);
  }

  public function store(RoleRequest $request): JsonResponse
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($role): JsonResponse|string
  {
    return json_encode([
      'data' => view('role.edit', [
        'data' => $this->service->find($role),
      ])->render()
    ]);
  }

  public function update(RoleRequest $request, $role): JsonResponse
  {
    if ($this->service->update($role, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($role): JsonResponse
  {
    if ($this->service->delete($role))
      return response()->json(['sukses' => 'Data berhasil dihapus.']);

    return response()->json(['gagal' => 'Data gagal dihapus.']);
  }
}
