<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuardSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Guard',
            'email' => 'guard@example.com',
            'role' => 'guard',
            'password' => Hash::make('12345678'),
        ]);
    }
}
