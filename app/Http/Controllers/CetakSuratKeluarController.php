<?php

namespace App\Http\Controllers;

use App\Http\Requests\CetakSuratKeluarRequest;
use App\Services\PhpSpreadsheet\CetakSuratKeluarService;
use Illuminate\View\View;

class CetakSuratKeluarController extends Controller
{
  public function __construct(
    protected CetakSuratKeluarService $service
  ) {
    // $this->middleware('isajaxreq')->except('index');
  }

  public function index(): View
  {
    return view('suratkeluar.cetak');
  }

  public function cetak(CetakSuratKeluarRequest $request): void
  {
    $this->service->cetak((object) $request->validated());
  }
}
