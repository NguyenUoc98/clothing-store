<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '0123456789',
            'address' => '123 Main Street',
            'password' => Hash::make('password123'),
        ]);
    }
}
