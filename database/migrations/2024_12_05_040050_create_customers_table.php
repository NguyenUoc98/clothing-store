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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('name'); // Tên khách hàng
            $table->string('email')->unique(); // Email (unique)
            $table->string('phone')->unique(); // Số điện thoại (unique)
            $table->string('address')->nullable();
            $table->string('password'); // Mật khẩu
            $table->timestamps(); // Tự động thêm created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
