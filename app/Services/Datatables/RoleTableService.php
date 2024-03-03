<?php

namespace App\Services\Datatables;

use App\Repositories\RoleRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class RoleTableService extends DatatableService
{
  public function __construct(
    protected RoleRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        return self::defaultBtn("akses", $data->id, "Akses", "General/Unlock.svg") .
          self::editBtn($data->id) .
          self::deleteBtn($data->id, $data->name);
      })
      ->rawColumns(['aksi'])
      ->make();
  }
}
