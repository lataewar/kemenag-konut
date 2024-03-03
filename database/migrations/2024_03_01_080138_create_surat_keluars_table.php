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
    Schema::create('surat_keluars', function (Blueprint $table) {
      $table->id();
      $table->date('date');

      $table->string('nomor', 10);
      $table->string('kombinasi')->unique();
      $table->string('sisipan', 5)->nullable();
      $table->string('full_nomor');

      $table->boolean('is_otomatis');
      $table->tinyInteger('kategori');
      $table->boolean('sifat');

      $table->foreignId('klasifikasi_id');
      $table->text('perihal');
      $table->string('asal')->nullable();
      $table->string('tujuan')->nullable();
      $table->foreignId('spesimen_id');
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
    Schema::dropIfExists('surat_keluars');
  }
};
