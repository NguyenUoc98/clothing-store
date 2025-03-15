<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5000, 50000), // Giá từ 5,000 đến 50,000 VND
            'sales_count' => $this->faker->numberBetween(1, 100), // Số lượng bán từ 1 đến 100
        ];
    }
}
