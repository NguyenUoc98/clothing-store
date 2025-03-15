<?php

// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Các thuộc tính và phương thức khác

    // Định nghĩa mối quan hệ nhiều-nhiều với products thông qua bảng trung gian transaction_product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_product')
                    ->withPivot('quantity', 'price') // Lấy thông tin bổ sung từ bảng trung gian
                    ->withTimestamps(); // Sử dụng timestamps nếu cần
    }
}

