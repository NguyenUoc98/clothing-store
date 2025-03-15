<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 
        'customer_name', 
        'customer_email', 
        'shipping_address', 
        'status', 
        'total_price'
    ];

    // Mối quan hệ với OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Tính tổng giá trị đơn hàng
    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->quantity * $item->price;
        }

        return $totalPrice;
    }

    // Tính tổng giá trị và lưu vào database mỗi khi đơn hàng được lưu
    public static function boot()
    {
        parent::boot();

        static::saved(function ($order) {
            $order->total_price = $order->calculateTotalPrice();
            $order->save();
        });
    }
}

