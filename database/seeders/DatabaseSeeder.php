<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admintes',
            'username' => 'admin1',
            'email' => 'admin1@disperum.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
