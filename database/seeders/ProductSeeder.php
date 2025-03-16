<?php
/**
 * Created by PhpStorm
 * Filename: ProductSeeder.php
 * User: Nguyễn Văn Ước
 * Date: 16/3/25
 * Time: 12:24
 */

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Yaml\Yaml;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = Yaml::parseFile(__DIR__ . '/products.yml');
        Schema::disableForeignKeyConstraints();
        Product::query()->truncate();
        foreach ($data as $item) {
            Product::query()->create($item);
        }
        Schema::enableForeignKeyConstraints();
    }
}
