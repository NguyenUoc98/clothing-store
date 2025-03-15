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
        Schema::table('products', function (Blueprint $table) {
            // Xóa cột product_code nếu có
            $table->dropColumn('product_code');

            // Thêm lại cột product_code với kiểu string, unique và không có giá trị mặc định
            $table->string('product_code')->unique()->nullable(); // Tùy chọn nullable hoặc không, nếu cần
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
