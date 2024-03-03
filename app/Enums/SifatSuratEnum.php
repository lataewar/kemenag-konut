<?php

namespace App\Enums;

enum SifatSuratEnum: int
{
  case BIASA = 1;
  case SEGERA = 2;
  case SANGAT_SEGERA = 3;

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case, 'name' => $case->getLabelText()]);
    }
    return $data;
  }

  public function isBiasa(): bool
  {
    return $this === self::BIASA;
  }

  public function isSegera(): bool
  {
    return $this === self::SEGERA;
  }

  public function isSangatSegera(): bool
  {
    return $this === self::SANGAT_SEGERA;
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::BIASA => "Biasa",
      self::SEGERA => "Segera",
      self::SANGAT_SEGERA => "Sangat Segera",
    };
  }

  private function getLabelColor(): string
  {
    return match ($this) {
      self::BIASA => "success",
      self::SEGERA => "warning",
      self::SANGAT_SEGERA => "danger",
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
