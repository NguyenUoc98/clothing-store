<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        // Tạo 10 sản phẩm mẫu
        Item::factory()->count(10)->create();
    }
}
