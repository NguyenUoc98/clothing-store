<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Tính tổng giá trị của OrderItem (quantity * price)
     */
    public function getTotalPrice()
    {
        return $this->quantity * $this->price;
    }

    /**
     * Kiểm tra tồn kho khi thêm OrderItem.
     * (Điều này có thể thêm logic tùy theo yêu cầu ứng dụng.)
     */
    public function checkStockAvailability()
    {
        $product = $this->product;
        if (!$product || $product->stock < $this->quantity) {
            // Log và thông báo không đủ hàng tồn kho
            Log::warning("Không đủ hàng tồn kho cho sản phẩm: {$product->name}");
            throw new \Exception("Không đủ hàng trong kho cho sản phẩm: {$product->name}");
        }
    }
}
