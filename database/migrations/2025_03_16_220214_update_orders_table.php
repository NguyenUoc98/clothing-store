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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_phone')->after('customer_email')->comment('Số điện thoại khách hàng');
            $table->smallInteger('status')->default(\App\Enum\PaymentStatus::INIT)->comment('Trạng thái thanh toán của đơn hàng')->change();
            $table->json('addition_information')->after('status')->nullable()->comment('Thông tin thêm: tiền khách đưa, tiền trả khách, ghi chú...');
            $table->tinyInteger('type')->after('status')->default(\App\Enum\PaymentType::COD)->comment('Loại hình thành toán: online - trả tiền mặt');
            $table->unsignedBigInteger('cart_id')->after('id')->comment('Khóa ngoại đến bảng giỏ hàng');

            $table->foreign('cart_id')->on('carts')->references('id')->cascadeOnUpdate();
        });

        Schema::dropIfExists('order_items');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['cart_id']);
            $table->dropColumn(['type', 'addition_information', 'cart_id']);
            $table->enum('status', ['processing', 'shipped', 'cancelled'])->default('processing')->change();
        });
    }
};
