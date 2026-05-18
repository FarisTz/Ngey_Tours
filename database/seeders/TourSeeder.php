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

        Tour::updateOrCreate(
            ['slug' => 'spice-prison-stone'],
            [
                'title' => 'Spice Farms, Prison Island & Stone Town Tour',
                'short' => 'Full day combined experiences tour visiting spice farms, prison island and Stone Town.',
                'image' => 'images/stone-town-tour1.png',
                'description' => 'This full-day tour starts with a drive to Spice Farms where a local guide shows the spice cultivation process, followed by a spiced rice lunch with tropical fruits. After lunch the group heads to Prison Island to see the giant tortoises, then a boat ride to Stone Town for a historic walk covering House of Wonders, Freddie Mercury House, Sultan’s Palace and the bustling market.',
                'highlights' => [
                    'Smell and testing the spices grown in Zanzibar Islands',
                    'Spiced Rice Pilau Lunch at the spice farm',
                    'Tropical Fruits; Mangoes, Bananas, Pineapple, Watermelon etc.',
                    'Visit historical sites in Stone Town; House of Wonders, Freddie Mercury House etc.',
                    'Swimming, Snorkeling, feeding the Giant tortoises at Prison Island.',
                ],
                'price' => 48.00,
                'duration' => 'Full Day',
                'location' => 'Stone Town & Prison Island',
            ]
        );
    }
}
