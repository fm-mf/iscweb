<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case Cash = 'cash';
    case Card = 'card';

    public function icon(): string
    {
        return match ($this) {
            self::Cash => 'fas fa-coins',
            self::Card => 'fas fa-credit-card',
        };
    }

    public static function default(): self
    {
        return self::Cash;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function keys(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function selectOptions(): array
    {
        return array_combine(self::keys(), self::values());
    }
}
