<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Services\Datatables\MenuTableService;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
  public function __construct(
    protected MenuService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create menu')->only(['create', 'store']);
    $this->middleware('permission:read menu')->only(['index', 'dt']);
    $this->middleware('permission:update menu')->only(['edit', 'update']);
    $this->middleware('permission:delete menu')->only(['destroy']);
  }

  public function index()
  {
    return view('menu.index');
  }

  public function dt(MenuTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('menu.table')->render()
      ]);
    }

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    return json_encode([
      'data' => view('menu.create')->render()
    ]);
  }

  public function store(MenuRequest $request): JsonResponse
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($menu)
  {
    return json_encode([
      'data' => view('menu.edit', [
        'data' => $this->service->find($menu),
      ])->render()
    ]);
  }

  public function update(MenuRequest $request, $menu)
  {
    if ($this->service->update($menu, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($menu)
  {
    if ($this->service->delete($menu))
      return response()->json(['sukses' => 'Data berhasil dihapus.']);

    return response()->json(['gagal' => 'Data gagal dihapus.']);
  }
}
