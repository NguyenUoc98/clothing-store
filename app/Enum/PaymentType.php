<?php

namespace App\Enum;

enum PaymentType: int
{
    case COD    = 1;
    case ONLINE = 2;
}
