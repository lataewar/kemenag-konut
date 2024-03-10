<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\SubMenuRequest;
use App\Services\Datatables\SubMenuTableService;
use App\Services\SubMenuService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class SubMenuController extends Controller
{
  public function __construct(
    protected SubMenuService $service
  ) {
    $this->middleware('isajaxreq')->except('index');

    $this->middleware('permission:create menu')->only(['create', 'store']);
    $this->middleware('permission:read menu')->only(['index', 'dt']);
    $this->middleware('permission:update menu')->only(['edit', 'update']);
    $this->middleware('permission:delete menu')->only(['destroy']);
  }

  public function index(Menu $menu): View
  {
    return view('submenu.index', ['id' => $menu->id]);
  }

  public function dt($menu): JsonResponse|string
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('submenu.table')->render()
      ]);
    }

    return app(SubMenuTableService::class)->table($menu);
  }

  public function create($menu): JsonResponse|string
  {
    return json_encode([
      'data' => view('submenu.create', ['menu' => $menu])->render()
    ]);
  }

  public function store($menu, SubMenuRequest $request)
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($menu, $submenu): JsonResponse|string
  {
    return json_encode([
      'data' => view('submenu.edit', [
        'menu' => $menu,
        'data' => $this->service->find($submenu),
      ])->render()
    ]);
  }

  public function update($menu, SubMenuRequest $request, $submenu)
  {
    if ($this->service->update($submenu, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($menu, $submenu)
  {
    if ($this->service->delete($submenu))
      return response()->json(['sukses' => 'Data berhasil dihapus.']);

    return response()->json(['gagal' => 'Data gagal dihapus.']);
  }
}
