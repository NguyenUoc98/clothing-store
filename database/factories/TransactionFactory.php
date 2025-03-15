<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'transaction_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'total_amount' => $this->faker->randomFloat(2, 10000, 100000), // từ 10,000 đến 100,000 VND
        ];
    }
}
