<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'addresses' => 'array',  // Laravel sẽ tự động chuyển đổi giữa JSON và mảng khi cần
    ];
}
