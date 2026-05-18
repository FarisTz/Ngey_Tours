<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::updateOrCreate(
            ['slug' => 'zanzibar-luxury'],
            [
                'title' => '5 DAYS LUXURY ZANZIBAR TOUR',
                'short' => 'Luxury Zanzibar package with island excursions and top accommodations.',
                'image' => 'images/stone-town-tour1.png',
                'description' => 'Discover the best of Zanzibar with luxury transfers, guided tours, and beach relaxation.',
                'highlights' => [
                    'Luxury',
                    'Beach',
                    'Island',
                ],
                'price' => 370.00,
                'duration' => '5 Days Tour',
                'location' => 'Zanzibar, Tanzania',
            ]
        );

        Package::updateOrCreate(
            ['slug' => 'serengeti-ngorongoro'],
            [
                'title' => 'SERENGETI & NGORONGORO CRATER',
                'short' => 'Three-day safari package to Tanzania’s top wildlife destinations.',
                'image' => 'images/dstone-town-tour.png',
                'description' => 'Includes Serengeti safari, Ngorongoro crater game drives, and premium accommodation.',
                'highlights' => [
                    'Safari',
                    'Wildlife',
                    'Crater',
                ],
                'price' => 1700.00,
                'duration' => '3 Days Tour',
                'location' => 'Zanzibar to Mainland Tanzania',
            ]
        );
    }
}
