<?php

namespace Database\Seeders;

use App\Models\TaxiRoute;
use Illuminate\Database\Seeder;

class TaxiRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            ['pickup_location' => 'Airport', 'destination' => 'Stone Town', 'distance' => '10 km', 'duration' => '25 min', 'price' => '$15', 'status' => 'active'],
            ['pickup_location' => 'Airport', 'destination' => 'Nungwi', 'distance' => '55 km', 'duration' => '1h 15m', 'price' => '$40', 'status' => 'active'],
            ['pickup_location' => 'Airport', 'destination' => 'Kendwa', 'distance' => '60 km', 'duration' => '1h 20m', 'price' => '$40', 'status' => 'active'],
            ['pickup_location' => 'Airport', 'destination' => 'Paje', 'distance' => '50 km', 'duration' => '1h 10m', 'price' => '$40', 'status' => 'active'],
            ['pickup_location' => 'Airport', 'destination' => 'Jambiani', 'distance' => '65 km', 'duration' => '1h 25m', 'price' => '$40', 'status' => 'active'],
        ];

        foreach ($routes as $route) {
            TaxiRoute::updateOrCreate(
                ['pickup_location' => $route['pickup_location'], 'destination' => $route['destination']],
                $route
            );
        }
    }
}
