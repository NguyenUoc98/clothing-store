<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $guarded = [];

    protected $casts = [
        'processed' => 'bool',
    ];

    /**
     * Thiết lập mối quan hệ với bảng `cart_items`.
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    /**
     * Thiết lập mối quan hệ với bảng `users`.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tính tổng giá trị của giỏ hàng.
     */
    public function totalPrice()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    /**
     * Tính tổng số lượng sản phẩm trong giỏ hàng.
     */
    public function totalQuantity()
    {
        return $this->items->sum('quantity');
    }

    /**
     * Kiểm tra giỏ hàng có trống hay không.
     */
    public function isEmpty()
    {
        return $this->items()->exists() === false;
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function addItem($productId, $quantity, $price)
    {
        $cartItem           = $this->items()->firstOrNew(['product_id' => $productId]);
        $cartItem->quantity += $quantity;
        $cartItem->price    = $price;
        $cartItem->save();
    }

    /**
     * Giảm sản phẩm hoặc xóa nếu số lượng <= 0.
     */
    public function removeItem($productId, $quantity)
    {
        $cartItem = $this->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity -= $quantity;

            if ($cartItem->quantity <= 0) {
                $cartItem->delete();
            } else {
                $cartItem->save();
            }
        }
    }
}
