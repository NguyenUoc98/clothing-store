<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('total_money')->default(0)->comment('Tổng số tiền của đơn hàng');
            $table->tinyInteger('type')->default(\App\Enum\PaymentType::CASH)->comment('Loại hình thành toán: online - trả tiền mặt');
            $table->smallInteger('status')->default(\App\Enum\PaymentStatus::INIT)->comment('Trạng thái thanh toán của đơn hàng');
            $table->json('addition_information')->nullable()->comment('Thông tin thêm: tiền khách đưa, tiền trả khách, ghi chú...');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['total_money', 'type', 'status', 'addition_information']);
        });
    }
};
