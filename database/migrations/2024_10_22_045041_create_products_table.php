<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::dropIfExists('products');
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // ID tự động tăng
        $table->string('name'); // Tên sản phẩm
        $table->text('description')->nullable(); // Mô tả sản phẩm, có thể để trống
        $table->unsignedBigInteger('category_id')->nullable(); // ID danh mục, liên kết với bảng categories (nếu có)
        $table->string('image')->nullable(); // Hình ảnh sản phẩm, có thể để trống
        $table->decimal('price', 8, 2); // Giá sản phẩm, giới hạn đến 2 chữ số thập phân
        $table->integer('stock')->default(0); // Số lượng sản phẩm trong kho, thay cho `quantity`
        $table->timestamps(); // Thêm trường `created_at` và `updated_at`
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
//            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
