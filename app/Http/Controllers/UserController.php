<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Services\Datatables\UserTableService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
  public function __construct(
    protected UserService $service
  ) {
    $this->middleware('isajaxreq')->except('index');
  }

  public function index(): View
  {
    return view('user.index');
  }

  public function dt(UserTableService $datatable): JsonResponse|string
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('user.table')->render()
      ]);
    }

    return $datatable->table();
  }

  public function create(): JsonResponse|string
  {
    return json_encode([
      'data' => view('user.create')->render()
    ]);
  }

  public function store(UserRequest $request): JsonResponse
  {
    if ($this->service->store($request))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }

  public function edit($user): JsonResponse|string
  {
    return json_encode([
      'data' => view('user.edit', [
        'data' => $this->service->find($user),
      ])->render()
    ]);
  }

  public function update(UserRequest $request, $user): JsonResponse
  {
    if ($this->service->update($user, $request))
      return response()->json(['sukses' => 'Data berhasil diubah.']);

    return response()->json(['gagal' => 'Data gagal diubah.']);
  }

  public function destroy($user): JsonResponse
  {
    if ($this->service->delete($user))
      return response()->json(['sukses' => 'Data berhasil dihapus.']);

    return response()->json(['gagal' => 'Data gagal dihapus.']);
  }

  public function multdelete(Request $request): JsonResponse
  {
    if ($this->service->multipleDelete($request->post('ids')))
      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);

    return response()->json(['gagal' => 'Data gagal ditambahkan.']);
  }
}
