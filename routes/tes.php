<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('tes', function () {
  // $date = Carbon::createFromFormat('Y-m-d', '2024-03-02');
  $date = Carbon::parse('2024-03-03')->startOfDay();
  $sy = Carbon::parse('2024-03-03')->startOfYear();
  $today = Carbon::now()->startOfDay();
  // $today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
  // $today = Carbon::now()->format('Y-m-d');

  dump($date);
  dump('sy : ' . $sy);
  dump('today : ' . $today);


  dump($date->eq($today));
});
