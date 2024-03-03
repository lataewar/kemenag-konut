<?php

namespace App\Enums;

enum MetodeSuratEnum: int
{
  case OTOMATIS = 1;
  case MANUAL = 0;

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case, 'name' => $case->getLabelText()]);
    }
    return $data;
  }

  public function isOtomatis(): bool
  {
    return $this === self::OTOMATIS;
  }

  public function isManual(): bool
  {
    return $this === self::MANUAL;
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::OTOMATIS => "Otomatis",
      self::MANUAL => "Manual",
    };
  }

  private function getLabelColor(): string
  {
    return match ($this) {
      self::OTOMATIS => "success",
      self::MANUAL => "warning",
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
