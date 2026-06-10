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
            
        ];

        foreach ($routes as $route) {
            TaxiRoute::updateOrCreate(
                ['pickup_location' => $route['pickup_location'], 'destination' => $route['destination']],
                $route
            );
        }
    }
}
