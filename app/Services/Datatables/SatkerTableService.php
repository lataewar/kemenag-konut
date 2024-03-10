<?php

namespace App\Services\Datatables;

use App\Repositories\SatkerRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class SatkerTableService extends DatatableService
{
  public function __construct(
    protected SatkerRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('update satker') ?
          self::editBtn($data->id) : '';
        $strMenu .= auth()->user()->can('delete satker') ?
          self::deleteBtn($data->id, $data->name) : '';

        return $strMenu;
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])

      ->make();
  }
}
