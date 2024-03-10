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
        return self::aksiDropdown(
          self::naviItem('javascript:;', 'Akses ke Menu', "la la-icons", "onclick=\"akses('" . $data->id . "')\"") .
          self::naviItem('javascript:;', 'Perizinan', "la la-lock-open", "onclick=\"izin('" . $data->id . "')\"") .
          self::navSeparator() .
          self::naviItem('javascript:;', 'Ubah Data', "la la-pencil", "onclick=\"edit('" . $data->id . "')\"") .
          self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', '" . $data->name . "')\"")
        );
      })
      ->rawColumns(['aksi'])
      ->make();
  }
}
