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
        Schema::table('customers', function (Blueprint $table) {
            $table->json('addresses')->nullable()->after('address'); // Thêm cột addresses (JSON)
            $table->unsignedBigInteger('default_address_id')->nullable()->after('addresses'); // Thêm cột default_address_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('addresses');
            $table->dropColumn('default_address_id');
        });
    }
};
