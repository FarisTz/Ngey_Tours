<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\TourSeeder;
use Database\Seeders\PackageSeeder;
use Database\Seeders\TaxiRouteSeeder;
use Database\Seeders\TaxiVehicleSeeder;
use Database\Seeders\BookingSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            TourSeeder::class,
            PackageSeeder::class,
            TaxiRouteSeeder::class,
            TaxiVehicleSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
