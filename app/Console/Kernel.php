<?php

namespace App\Console;

use App\Repositories\TemporaryFileRepository;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
  /**
   * Define the application's command schedule.
   */
  protected function schedule(Schedule $schedule): void
  {
    // laravel command cannot be used on shared hosting server because proc_open php function is not active
    // $schedule->command('app:clear-temp')->everyTenMinutes();
    $schedule->call(function () {
      app(TemporaryFileRepository::class)->deleteTemporary();
      Log::info('Scheduler clear temporary file berhasil dijalankan');
    })->everyDay();
  }

  /**
   * Register the commands for the application.
   */
  protected function commands(): void
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }
}
