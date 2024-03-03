<?php

namespace App\Http\Controllers;

use App\Http\Requests\KodeKlasifikasiRequest;
use App\Models\KodeInstansi;
use App\Services\KodeInstansiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KodeInstansiController extends Controller
{
  public function __construct(
    protected KodeInstansiService $service
  ) {
  }

  public function index(): View
  {
    return view('kd_instansi.index', [
      'data' => KodeInstansi::first()
    ]);
  }

  public function update(KodeKlasifikasiRequest $request, $kdin): RedirectResponse
  {
    $this->service->update($kdin, $request);
    return redirect(route('kdins.index'));
  }
}
