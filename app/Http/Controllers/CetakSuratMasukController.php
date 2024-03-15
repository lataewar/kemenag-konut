<?php

namespace App\Http\Controllers;

use App\Http\Requests\CetakSuratKeluarRequest;
use App\Services\PhpSpreadsheet\CetakSuratMasukService;
use Illuminate\View\View;

class CetakSuratMasukController extends Controller
{
  public function __construct(
    protected CetakSuratMasukService $service
  ) {
    $this->middleware('permission:print surat_masuk');
  }

  public function index(): View
  {
    return view('suratmasuk.cetak');
  }

  public function cetak(CetakSuratKeluarRequest $request): void
  {
    $this->service->cetak((object) $request->validated());
  }
}
