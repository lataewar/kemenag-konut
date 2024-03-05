<?php

namespace App\Http\Controllers;

use App\Http\Requests\CetakSuratKeluarRequest;
use App\Services\PhpSpreadsheet\CetakSuratKeluarService;
use Illuminate\Http\Request;
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

  public function cetak(CetakSuratKeluarRequest $request)
  {
    return $this->service->cetak((object) $request->validated());
  }
}
