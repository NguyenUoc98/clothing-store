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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // ID của giỏ hàng
            $table->unsignedBigInteger('user_id')->nullable(); // Liên kết với người dùng (nếu có)
            $table->string('guest_id')->nullable(); // Liên kết với khách chưa đăng nhập (UUID)
            $table->timestamps(); // created_at và updated_at
        
            // Tạo khóa ngoại liên kết với bảng users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
