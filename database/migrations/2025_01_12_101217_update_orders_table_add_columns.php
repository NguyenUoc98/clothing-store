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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Liên kết với người dùng (nếu có)
            $table->decimal('total_price', 10, 2)->default(0); // Tổng giá trị của đơn hàng
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('total_price');
        });
    }
};
