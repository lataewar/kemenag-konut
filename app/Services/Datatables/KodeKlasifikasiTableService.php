<?php

namespace App\Services\Datatables;

use App\Repositories\KodeKlasifikasiRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class KodeKlasifikasiTableService extends DatatableService
{
  public function __construct(
    protected KodeKlasifikasiRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('update klasifikasi') ?
          self::editBtn($data->id) : '';
        $strMenu .= auth()->user()->can('delete klasifikasi') ?
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
