<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        // Tạo 10 giao dịch mẫu
        Transaction::factory()->count(10)->create();
    }
}
