<?php

namespace App\Services\Datatables;

use App\Repositories\SuratKeluarRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class SuratKeluarTableService extends DatatableService
{
  public function __construct(
    protected SuratKeluarRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        return self::aksiDropdown(
          self::naviItem('javascript:;', 'Unggah Berkas', "la la-file-upload", "onclick=\"berkas('" . $data->id . "')\"") .
          self::naviItem('javascript:;', 'Ubah Data', "la la-pencil", "onclick=\"edit('" . $data->id . "')\"") .
          self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', '" . $data->full_nomor . "')\"")
        );
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
      })
      ->addColumn('nomor', function ($data) {
        return "<div>
                  <span class='text-dark-75 font-weight-bold line-height-sm d-block pb-2 '>$data->nomor</span>
                  <span class='text-success'><small>$data->full_nomor</small></span>
                </div>";
      })
      ->addColumn('date', function ($data) {
        return "<div>
                  <span class='text-dark-75 font-weight-bold line-height-sm d-block pb-2 '>$data->date</span>
                  <span class='text-muted'><small>$data->created_at</small></span>
                </div>";
      })
      ->addColumn('perihal', function ($data) {
        return "<small>$data->perihal</small>";
      })
      ->addColumn('tujuan', function ($data) {
        return "<small>$data->tujuan</small>";
      })
      ->addColumn('berkas', function ($data) {
        $berkas = "tes";
        if (!$data->hasMedia('berkas_suratkeluar'))
          $berkas = self::label('Belum Ada', 'danger');
        else
          $berkas = "<a href='" . $data->getMedia('berkas_suratkeluar')->first()->getUrl() . "' target='_blank'>Berkas</a>";
        return $berkas;
      })
      ->rawColumns(['aksi', 'cb', 'nomor', 'date', 'perihal', 'tujuan', 'berkas'])
      ->make();
  }
}
