<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;
use App\Models\Location;

class ShiftSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $location = Location::first();

        if ($location) {
            Shift::create([
                'location_id' => $location->id,
                'name' => 'Shift Pagi',
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
            ]);

            Shift::create([
                'location_id' => $location->id,
                'name' => 'Shift Malam',
                'start_time' => '16:00:00',
                'end_time' => '00:00:00',
            ]);
        }
    }
}
