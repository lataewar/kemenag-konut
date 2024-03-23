<?php

namespace App\Http\Controllers;

use App\Services\BackupRestoreService;
use Illuminate\Http\Request;

class BackupRestoreController extends Controller
{
  public function __construct(
    protected BackupRestoreService $service
  ) {

  }

  public function index()
  {
    return view('backuprestore.index', [
      'data' => $this->service->all(),
    ]);
  }

  public function store(Request $request)
  {

  }
}
