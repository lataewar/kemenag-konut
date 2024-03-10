<?php

namespace App\Services\Datatables;

use App\Repositories\SpesimenRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class SpesimenTableService extends DatatableService
{
  public function __construct(
    protected SpesimenRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('update spesimen') ?
          self::editBtn($data->id) : '';
        $strMenu .= auth()->user()->can('delete spesimen') ?
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
