<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'email' => 'daogam26@gmailgmail.com',
            'password' => Hash::make('password'),
            'password' => 'Daogam12345@',
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
