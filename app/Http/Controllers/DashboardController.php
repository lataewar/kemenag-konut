<?php

namespace App\Http\Controllers;

use App\Services\KodeKlasifikasiService;
use App\Services\SpesimenService;
use App\Services\SuratKeluarService;

class DashboardController extends Controller
{
  public function __construct(
    protected SuratKeluarService $service
  ) {
    $this->middleware('isajaxreq')->except('index');
  }

  public function index()
  {
    return view('dashboard.index', [
      'suratkeluar' => $this->service->getCountNomorByCurrentYear(),
      'lastnomor' => $this->service->getLastNomorByCurrentYear(),
    ]);
  }

  public function createNomor()
  {
    $data = [
      'klasifikasis' => app(KodeKlasifikasiService::class)->getSelectionData(),
      'spesimens' => app(SpesimenService::class)->getAll(),
    ];

    return json_encode(['data' => view('dashboard.createnomor', $data)->render()]);
  }
}
