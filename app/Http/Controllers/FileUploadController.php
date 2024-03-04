<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
  // For image only
  public function processImg(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'image|mimes:jpg,jpeg,png|max:512|required',
    ]);

    // Check validation failure
    if ($validator->fails()) {
      abort(422, 'You tried to pass the front end validation. lol');
    }

    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $filename = $file->getClientOriginalName();
      $folder = uniqid() . '-' . now()->timestamp;
      $file->storeAs('files/tmp/' . $folder, $filename);

      TemporaryFile::create([
        'folder' => $folder,
        'filename' => $filename
      ]);

      // app('debugbar')->disable();
      return $folder;
    }

    return '';
  }

  public function revert()
  {
    // app('debugbar')->disable();

    $temporaryFile = TemporaryFile::where('folder', request()->getContent())->first();
    unlink(storage_path('app/public/files/tmp/' . request()->getContent() . '/' . $temporaryFile->filename));
    rmdir(storage_path('app/public/files/tmp/' . request()->getContent()));
    $temporaryFile->delete();

    return 'Sukses';
  }

  // For files
  public function processFile(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'mimes:pdf|max:512|required',
    ]);

    // Check validation failure
    if ($validator->fails()) {
      abort(422, 'You tried to pass the front end validation. lol');
    }

    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $folder = uniqid() . '-' . now()->timestamp;
      $filename = $folder . ".pdf";
      $file->storeAs('files/tmp/' . $folder, $filename);

      TemporaryFile::create([
        'folder' => $folder,
        'filename' => $filename
      ]);

      // app('debugbar')->disable();
      return $folder;
    }

    return '';
  }
}
