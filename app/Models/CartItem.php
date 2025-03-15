<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price'];

    /**
     * Thiết lập mối quan hệ với bảng `carts`.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Thiết lập mối quan hệ với bảng `products`.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Tính giá trị của sản phẩm trong giỏ hàng (giá * số lượng).
     */
    public function totalPrice()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     */
    public function updateQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->save();
    }

    /**
     * Cập nhật giá sản phẩm trong giỏ hàng (nếu cần).
     */
    public function updatePrice($price)
    {
        $this->price = $price;
        $this->save();
    }
}
