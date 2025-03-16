<?php

namespace App\Enum;

enum PaymentType: int
{
    case CASH   = 1;
    case ONLINE = 2;
}
