<?php

namespace App\Enum;

enum PaymentStatus: int
{
    case ERROR      = -1;
    case INIT       = 0;
    case PROCESSING = 1;
    case SHIPPING   = 2;
    case SUCCESS    = 3;

    public function description(): string
    {
        return match ($this) {
            PaymentStatus::ERROR      => 'Lỗi',
            PaymentStatus::INIT       => 'Chưa thanh toán',
            PaymentStatus::PROCESSING => 'Đang xử lý',
            PaymentStatus::SHIPPING   => 'Đang giao hàng',
            PaymentStatus::SUCCESS    => 'Thành công',
            default                   => 'Không xác định',
        };
    }
}
