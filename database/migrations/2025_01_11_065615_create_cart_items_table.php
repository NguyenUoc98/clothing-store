<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id(); // ID của sản phẩm trong giỏ
            $table->unsignedBigInteger('cart_id'); // Liên kết với giỏ hàng
            $table->unsignedBigInteger('product_id'); // Liên kết với sản phẩm
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm tại thời điểm thêm vào giỏ
            $table->timestamps(); // created_at và updated_at
        
            // Khóa ngoại liên kết
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
