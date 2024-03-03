<?php

namespace App\Enums;

enum KategoriSuratEnum: int
{
  case SURAT_KELUAR = 1;
  case SURAT_KEPUTUSAN = 2;

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case, 'name' => $case->getLabelText()]);
    }
    return $data;
  }

  public function isSuratKeluar(): bool
  {
    return $this === self::SURAT_KELUAR;
  }

  public function isSuratKeputusan(): bool
  {
    return $this === self::SURAT_KEPUTUSAN;
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::SURAT_KELUAR => "Surat Keluar",
      self::SURAT_KEPUTUSAN => "Surat Keputusan",
    };
  }

  private function getLabelColor(): string
  {
    return match ($this) {
      self::SURAT_KELUAR => "success",
      self::SURAT_KEPUTUSAN => "primary",
    };
  }

  public function getLabelHTML(): string
  {
    return sprintf(
      '<span class="label label-light-%s font-weight-bold label-inline">%s</span>',
      $this->getLabelColor(),
      $this->getLabelText()
    );
  }
}
