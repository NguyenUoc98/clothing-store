<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'customer';  

    protected $fillable = [
        'name',
        'email',
        'phone',
        'addresses',   // Thêm addresses vào đây
        'default_address_id', // Thêm default_address_id vào đây
        'password',
        'status',
        'token',
        'remember_token'
    ];

    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'addresses' => 'array',  // Laravel sẽ tự động chuyển đổi giữa JSON và mảng khi cần
    ];
}
