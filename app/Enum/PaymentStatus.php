<?php

namespace App\Enum;

enum PaymentStatus: int
{
    case INIT       = 0;
    case SHIPPING   = 2;
    case SUCCESS    = 3;

    public function description(): string
    {
        return match ($this) {
            PaymentStatus::INIT       => 'Chờ xác nhận',
            PaymentStatus::SHIPPING   => 'Đang giao hàng',
            PaymentStatus::SUCCESS    => 'Thành công',
        };
    }
}
