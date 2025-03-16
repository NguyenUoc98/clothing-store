<?php

namespace App\Enum;

enum PaymentStatus: int
{
    case ERROR      = -1;
    case INIT       = 0;
    case PROCESSING = 1;
    case SUCCESS    = 2;
}
