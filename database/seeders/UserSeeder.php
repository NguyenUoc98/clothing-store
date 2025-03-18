<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::query()->truncate();
        User::create([
            'name' => 'Admin User',
            'email' => 'daogam26@gmail.com',
            'password' => Hash::make('Daogam12345@'),
            'role' => 'admin',
        ]);

        // Tạo 1 staff
        User::create([
            'name' => 'Staff User',
            'email' => 'gamdtpp02814@fpt.edu.vnvn',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
