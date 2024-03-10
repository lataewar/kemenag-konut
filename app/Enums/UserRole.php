<?php

namespace App\Enums;

enum UserRole: int
{
  case SUPER_ADMIN = 1;
  case ADMIN = 2;
  case PIMPINAN = 3;
  case SATKER = 4;

  public static function toArray(): array
  {
    $data = [];
    foreach (self::cases() as $case) {
      array_push($data, ['id' => $case, 'name' => $case->getLabelText()]);
    }
    return $data;
  }

  public function isSuperAdmin(): bool
  {
    return $this === self::SUPER_ADMIN;
  }

  public function isAdmin(): bool
  {
    return $this === self::ADMIN;
  }

  public function isPimpinan(): bool
  {
    return $this === self::PIMPINAN;
  }

  public function isSatker(): bool
  {
    return $this === self::SATKER;
  }

  public function getName(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "super admin",
      self::ADMIN => "admin",
      self::PIMPINAN => "pimpinan",
      self::SATKER => "satker",
    };
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "Super Administrator",
      self::ADMIN => "Administrator",
      self::PIMPINAN => "Pimpinan",
      self::SATKER => "Satuan Kerja",
    };
  }

  private function getLabelColor(): string
  {
    return match ($this) {
      self::SUPER_ADMIN => "danger",
      self::ADMIN => "warning",
      self::PIMPINAN => "success",
      self::SATKER => "primary",
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
