<?php

namespace App\Services\Datatables;

use App\Repositories\PermissionRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class PermissionTableService extends DatatableService
{
  public function __construct(
    protected PermissionRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        return self::editBtn($data->id) .
          self::deleteBtn($data->id, $data->name);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }
}
