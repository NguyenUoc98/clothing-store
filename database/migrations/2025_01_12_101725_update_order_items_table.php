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
        Schema::table('order_items', function (Blueprint $table) {
            // Thêm khóa ngoại đến bảng orders nếu chưa tồn tại
            if (!Schema::hasColumn('order_items', 'order_id')) {
                $table->foreignId('order_id')->constrained()->onDelete('cascade');
            }

            // Thêm khóa ngoại đến bảng products nếu chưa tồn tại
            if (!Schema::hasColumn('order_items', 'product_id')) {
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Xóa khóa ngoại nếu có
            $table->dropForeign(['order_id']);
            $table->dropForeign(['product_id']);
        });
    }
};
