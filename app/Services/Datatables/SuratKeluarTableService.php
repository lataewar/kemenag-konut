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
        $strMenu = auth()->user()->can('create nomor') ?
          self::naviItem('javascript:;', 'Unggah Berkas', "la la-file-upload", "onclick=\"berkas('" . $data->id . "')\"") : '';
        $strMenu .= auth()->user()->can('update nomor') ?
          self::naviItem('javascript:;', 'Ubah Data', "la la-pencil", "onclick=\"edit('" . $data->id . "')\"") : '';
        $strMenu .= auth()->user()->can('delete nomor') ?
          self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', '" . $data->full_nomor . "')\"") : '';

        return self::aksiDropdown($strMenu);
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
        return "<div>
                  <span class='text-dark-75 font-weight-bold line-height-sm d-block pb-2 '>$data->tujuan</span>
                  <span class='text-muted'><small>" . $data->user->name . "</small></span>
                </div>";
      })
      ->addColumn('berkas', function ($data) {
        $berkas = "tes";
        if (!$data->hasMedia())
          $berkas = self::label('Belum Ada', 'danger');
        else
          $berkas = "<a href='" . $data->getMedia()->first()->getUrl() . "' target='_blank'>Berkas</a>";
        return $berkas;
      })
      ->rawColumns(['aksi', 'cb', 'nomor', 'date', 'perihal', 'tujuan', 'berkas'])
      ->make();
  }
}
