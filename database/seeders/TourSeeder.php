<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        Tour::updateOrCreate(
            ['slug' => 'safari-blue'],
            [
                'title' => 'Zanzibar Safari Blue Trip',
                'short' => 'Full day tour along Menai Bay with snorkeling, BBQ, and island visits.',
                'image' => 'images/safari_blue.jpg',
                'description' => 'Safari Blue trip is a full day tour along Menai bay, which is one of the best coral reefs in Zanzibar. Main activities include visiting sandbanks, swimming & snorkeling in crystal clear waters, visiting Kwale island with its natural green lagoon and climbing the old Baobab tree for spectacular views. Fresh seafood BBQ and tropical fruit tasting are included.',
                'highlights' => [
                    'Swimming and Snorkeling around Menai Bay area',
                    'Seafoods BBQ Lunch; Octopus, Lobsters, Squids, Prawns, etc.',
                    'Tropical Fruits; Mangoes, Bananas, Pineapple, Watermelon etc.',
                    'Sailing with Traditional boat',
                    'Visit Kwale Island, natural Lagoon & Sandbank',
                ],
                'price' => 49.00,
                'duration' => 'Full Day',
                'location' => 'Menai Bay, Zanzibar',
            ]
        );

    }
}
