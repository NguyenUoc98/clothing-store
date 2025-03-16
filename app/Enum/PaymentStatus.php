<?php

namespace App\Enum;

enum PaymentStatus: int
{
    const ERROR      = -1;
    const INIT       = 0;
    const PROCESSING = 1;
    const SUCCESS    = 2;
}
