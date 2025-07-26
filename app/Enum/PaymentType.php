<?php

namespace App\Enum;

enum PaymentType: int
{
    case COD    = 1;
    case ONLINE = 2;

    public function description(): string
    {
        return match ($this) {
            PaymentType::COD    => 'Tiền mặt',
            PaymentType::ONLINE => 'Online',
            default             => 'Không xác định',
        };
    }
}
