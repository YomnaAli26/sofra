<?php

namespace App\Enums;

enum RestaurantStatusEnum: int
{
    case OPEN = 1;
    case CLOSED = 0;

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::CLOSED => 'Closed',
        };
    }
}

