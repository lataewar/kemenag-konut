<?php

namespace App\Console\Commands;

use App\Repositories\TemporaryFileRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ClearTempCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:clear-temp';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Delete temporary file uploads that are not used within 10 minutes';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    app(TemporaryFileRepository::class)->deleteTemporary();
    Log::info('Scheduler clear temporary file berhasil dijalankan');
  }
}
