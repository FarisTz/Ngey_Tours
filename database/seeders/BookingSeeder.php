<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing tours and packages
        $tours = Tour::all();
        $packages = Package::all();

        if ($tours->isEmpty() && $packages->isEmpty()) {
            $this->command->warn('No tours or packages found. Please run TourSeeder and PackageSeeder first.');
            return;
        }

        // Sample customer names and emails
        $customers = [
            ['name' => 'John Smith', 'email' => 'john.smith@example.com'],
            ['name' => 'Sarah Johnson', 'email' => 'sarah.j@example.com'],
            ['name' => 'Michael Brown', 'email' => 'michael.brown@example.com'],
            ['name' => 'Emily Davis', 'email' => 'emily.davis@example.com'],
            ['name' => 'David Wilson', 'email' => 'david.wilson@example.com'],
            ['name' => 'Lisa Anderson', 'email' => 'lisa.anderson@example.com'],
            ['name' => 'James Taylor', 'email' => 'james.taylor@example.com'],
            ['name' => 'Maria Garcia', 'email' => 'maria.garcia@example.com'],
            ['name' => 'Robert Martinez', 'email' => 'robert.m@example.com'],
            ['name' => 'Jennifer Lee', 'email' => 'jennifer.lee@example.com'],
        ];

        // Status options
        $statuses = ['pending', 'confirmed', 'ongoing', 'completed', 'cancelled'];

        // Booking types
        $bookingTypes = ['tour', 'package', 'car'];

        // Locations for car bookings
        $pickupLocations = [
            'Kilimanjaro International Airport',
            'Arusha Airport',
            'Mount Meru Hotel',
            'Arusha City Center',
            'Moshi Town',
            'Kilimanjaro Region',
            'Lake Manyara Airport',
            'Serengeti Gate',
            'Ngorongoro Crater Gate',
            'Tarangire Gate'
        ];

        $destinations = [
            'Mount Kilimanjaro',
            'Serengeti National Park',
            'Ngorongoro Crater',
            'Lake Manyara National Park',
            'Tarangire National Park',
            'Arusha National Park',
            'Zanzibar Airport',
            'Dodoma City',
            'Moshi Town',
            'Arusha City'
        ];

        // Special requests examples
        $specialRequests = [
            null,
            'Vegetarian meal required',
            'Need wheelchair accessibility',
            'Birthday celebration - please arrange cake',
            'Allergic to nuts',
            'Requesting window seat',
            'Need extra blankets',
            'Traveling with infant',
            'Requesting English speaking guide',
            'Need airport pickup assistance',
        ];

        // Admin notes examples
        $adminNotes = [
            null,
            'VIP customer - special attention',
            'Confirmed via phone call',
            'Requires follow-up',
            'Already processed payment',
            'Customer requested early check-in',
            'Group booking - 2 rooms needed',
            'Special discount applied',
            'Rescheduled from previous date',
            'Waiting for payment confirmation',
        ];

        for ($i = 0; $i < 50; $i++) {
            $bookingType = $bookingTypes[array_rand($bookingTypes)];
            $status = $statuses[array_rand($statuses)];
            $customer = $customers[array_rand($customers)];

            // Generate random dates within the last 3 months and next 3 months
            $startDate = \Carbon\Carbon::now()->addDays(rand(-90, 90));
            $endDate = $bookingType != 'tour' ? $startDate->copy()->addDays(rand(1, 14)) : null;

            // Determine tour_id or package_id based on booking type
            $tourId = null;
            $packageId = null;

            if ($bookingType == 'tour' && $tours->isNotEmpty()) {
                $tourId = $tours->random()->id;
            } elseif ($bookingType == 'package' && $packages->isNotEmpty()) {
                $packageId = $packages->random()->id;
            } else {
                // If no tours/packages, default to car booking
                $bookingType = 'car';
            }

            // Generate random passenger counts
            $numAdults = rand(1, 6);
            $numChildren = rand(0, 4);

            // Calculate pricing
            $basePrice = 0;
            if ($bookingType == 'tour' && $tourId) {
                $tour = Tour::find($tourId);
                $basePrice = $tour ? $tour->price * ($numAdults + $numChildren * 0.5) : rand(150000, 500000);
            } elseif ($bookingType == 'package' && $packageId) {
                $package = Package::find($packageId);
                $basePrice = $package ? $package->price * ($numAdults + $numChildren * 0.5) : rand(300000, 1500000);
            } else {
                // Car booking pricing
                $days = $endDate ? $startDate->diffInDays($endDate) + 1 : 1;
                $basePrice = rand(50000, 300000) * $days;
            }


            // Generate unique booking reference
            $reference = 'BK' . date('Y') . date('m') . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);

            Booking::create([
                'booking_type' => $bookingType,
                'Full_name' => $customer['name'],
                'Email' => $customer['email'],
                'tour_id' => $tourId,
                'package_id' => $packageId,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'num_children' => $numChildren,
                'num_adults' => $numAdults,
                'special_requests' => $specialRequests[array_rand($specialRequests)],
                'pickup_location' => ($bookingType == 'car') ? $pickupLocations[array_rand($pickupLocations)] : null,
                'destination' => ($bookingType == 'car') ? $destinations[array_rand($destinations)] : null,
                'status' => $status,
                'booking_reference' => $reference . $i,
                'admin_notes' => $adminNotes[array_rand($adminNotes)],
                'created_at' => $startDate->copy()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Created ' . Booking::count() . ' bookings successfully!');

        // Display summary
        $this->command->table(
            ['Booking Type', 'Count', 'Total Revenue'],
            [
                ['Tour', Booking::where('booking_type', 'tour')->count(), number_format(Booking::where('booking_type', 'tour')->sum('total_price'), 0) . ' TZS'],
                ['Package', Booking::where('booking_type', 'package')->count(), number_format(Booking::where('booking_type', 'package')->sum('total_price'), 0) . ' TZS'],
                ['Car', Booking::where('booking_type', 'car')->count(), number_format(Booking::where('booking_type', 'car')->sum('total_price'), 0) . ' TZS'],
                ['Total', Booking::count(), number_format(Booking::sum('total_price'), 0) . ' TZS'],
            ]
        );
    }
}
