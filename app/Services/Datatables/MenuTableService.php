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
        $strMenu = $data->has_submenu ? self::btn("menu/submenu/" . $data->id, "Sub Menu") : "";
        $strMenu .= auth()->user()->can('update menu') ?
          self::editBtn($data->id) : '';
        $strMenu .= auth()->user()->can('delete menu') ?
          self::deleteBtn($data->id, $data->name) : '';

        return $strMenu;
      })
      ->rawColumns(['aksi', 'has_submenu'])
      ->make();
  }
}
