<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('surat_masuks', function (Blueprint $table) {
      $table->id();
      $table->date('date');

      $table->string('nomor');
      $table->text('perihal');
      $table->string('asal')->nullable();
      $table->foreignId('satker_id');

      $table->text('desc')->nullable();

      $table->foreignId('user_id');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('surat_masuks');
  }
};
