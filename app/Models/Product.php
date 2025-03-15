<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description', 
        'category_id', 
        'image',
        'size', 
        'price',
        'stock',
        'color',
        'product_code'
    ];

    // Quan hệ với OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_product')
                    ->withPivot('quantity', 'price') // Lấy thông tin bổ sung từ bảng trung gian
                    ->withTimestamps(); // Sử dụng timestamps nếu cần
    }

    /**
     * Giảm số lượng sản phẩm trong kho khi sản phẩm được thêm vào giỏ hàng.
     */
    public function decreaseStock($quantity)
    {
        if ($this->stock < $quantity) {
            throw new \Exception('Không đủ hàng trong kho');
        }

        $this->stock -= $quantity;
        $this->save();
    }

    /**
     * Tăng số lượng sản phẩm trong kho khi đơn hàng bị hủy hoặc giảm bớt.
     */
    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }

    /**
     * Kiểm tra số lượng sản phẩm trong kho có đủ để thêm vào giỏ hàng không.
     */
    public function hasSufficientStock($quantity)
    {
        return $this->stock >= $quantity;
    }

    /**
     * Lấy giá sản phẩm, có thể có giảm giá nếu cần thiết.
     */
    public function getFinalPrice()
    {
        // Nếu có logic giảm giá, có thể thêm ở đây
        return $this->price;
    }
}
