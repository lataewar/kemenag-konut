<?php

namespace App\Services\Datatables;

use App\Repositories\MenuRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class MenuTableService extends DatatableService
{
  public function __construct(
    protected MenuRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('has_submenu', function ($data) {
        return $data->has_submenu ? self::label("Ya") : self::label("Tidak", "warning");
      })
      ->addColumn('aksi', function ($data) {
        $hasSubmenu = $data->has_submenu ? self::btn("menu/submenu/" . $data->id, "Sub Menu") : "";
        return $hasSubmenu . self::editBtn($data->id) . self::deleteBtn($data->id, $data->name);
      })
      ->rawColumns(['aksi', 'has_submenu'])
      ->make();
  }
}
