<?php
/**
 * Created by PhpStorm
 * Filename: ProductSeeder.php
 * User: Nguyễn Văn Ước
 * Date: 16/3/25
 * Time: 12:24
 */

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Yaml\Yaml;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $data = Yaml::parseFile(__DIR__ . '/categories.yml');
        Schema::disableForeignKeyConstraints();
        Category::query()->truncate();
        foreach ($data as $item) {
            Category::query()->create($item);
        }
        Schema::enableForeignKeyConstraints();
    }
}
