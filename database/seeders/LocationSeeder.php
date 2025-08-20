<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Location::create([
            'name' => 'Kantor Pusat',
            'latitude' => -8.0299973,
            'longitude' => 112.6202317,
            'radius' => 30,
        ]);
    }
}
