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
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'color')) {
            $table->string('color')->nullable();        // Chỉ thêm nếu chưa có cột color
        }
        if (!Schema::hasColumn('products', 'product_code')) {
            $table->string('product_code')->unique();   // Chỉ thêm nếu chưa có cột product_code
        }
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        if (Schema::hasColumn('products', 'color')) {
            $table->dropColumn('color');
        }
        if (Schema::hasColumn('products', 'product_code')) {
            $table->dropColumn('product_code');
        }
    });
}

};
