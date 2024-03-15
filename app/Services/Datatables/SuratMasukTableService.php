<?php

namespace App\Services\Datatables;

use App\Repositories\SuratMasukRepository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class SuratMasukTableService extends DatatableService
{
  public function __construct(
    protected SuratMasukRepository $repository
  ) {
  }

  public function table(): JsonResponse
  {
    return DataTables::of($this->repository->table())
      ->addColumn('aksi', function ($data) {
        $strMenu = auth()->user()->can('update surat_masuk') ?
          self::naviItem('javascript:;', 'Ubah Data', "la la-pencil", "onclick=\"edit('" . $data->id . "')\"") : '';
        $strMenu .= auth()->user()->can('delete surat_masuk') ?
          self::naviItem('javascript:;', 'Hapus Data', "la la-trash", "onclick=\"destroy('" . $data->id . "', '" . $data->nomor . "')\"") : '';

        return self::aksiDropdown($strMenu);
      })
      ->addColumn('cb', function ($data) {
        return self::checkBox($data->id);
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
      ->addColumn('asal', function ($data) {
        return "<div>
                  <span class='text-dark-75 font-weight-bold line-height-sm d-block pb-2 '>$data->asal</span>
                  <span class='text-muted'><small>" . $data->satker->name . "</small></span>
                </div>";
      })
      ->addColumn('berkas', function ($data) {
        $berkas = "";
        if (!$data->hasMedia())
          $berkas = self::label('Belum Ada', 'danger');
        else
          $berkas = "<a href='" . $data->getMedia()->first()->getUrl() . "' target='_blank'>Berkas</a>";
        return $berkas;
      })
      ->rawColumns(['aksi', 'cb', 'nomor', 'date', 'perihal', 'asal', 'berkas'])
      ->make();
  }
}
