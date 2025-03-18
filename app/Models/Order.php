<?php

namespace App\Models;

use App\Enum\PaymentStatus;
use App\Enum\PaymentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status'               => PaymentStatus::class,
        'type'                 => PaymentType::class,
        'addition_information' => 'array',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function getOrderNumberAttribute()
    {
        return md5($this->id);
    }
}

