<?php

namespace Database\Seeders;

use App\Models\TaxiVehicle;
use Illuminate\Database\Seeder;

class TaxiVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            ['name' => 'Toyota Alphard', 'capacity' => '1–6 Passengers',  'type' => 'Luxury Transfer', 'image' => 'images/tour_box_1.webp', 'status' => 'active'],
            ['name' => 'Toyota Hiace', 'capacity' => '7–14 Passengers',  'type' => 'Comfort & Space', 'image' => 'images/tour_box_1.webp', 'status' => 'active'],
            ['name' => 'Coaster Bus', 'capacity' => '15–28 Passengers',  'type' => 'Large Group Travel', 'image' => 'images/tour_box_1.webp', 'status' => 'active'],
        ];

        foreach ($vehicles as $vehicle) {
            TaxiVehicle::updateOrCreate(
                ['name' => $vehicle['name']],
                $vehicle
            );
        }
    }
}
