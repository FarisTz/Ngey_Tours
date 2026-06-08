<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\TaxiBooking;
use App\Models\TaxiRoute;
use App\Models\TaxiVehicle;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class UserController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        return view('dashboard');
    }

    public function about()
    {
        return view('user.about');
    }
    public function destination()
    {
            $packages = Package::orderBy('created_at', 'desc')->get();
            return view('user.destination', compact('packages'));
        }


    public function contact()
    {
        return view('user.contact');
    }

    public function taxi()
    {
        $features = [
            'No Hidden Charges',
            'Free Airport Waiting Time',
            'Professional Drivers',
            '24/7 Availability',
            'Fixed Prices',
            'Safe & Comfortable Vehicles',
        ];

        $popularRoutes = TaxiRoute::where('status', 'active')->orderBy('pickup_location')->orderBy('destination')->get();

        $fleet = TaxiVehicle::where('status', 'active')->orderBy('name')->get();

        $hotelTransfers = [
            ['route' => 'Paje → Nungwi', 'distance' => '60 km', 'time' => '1h 20m', 'price' => '$45'],
            ['route' => 'Kendwa → Stone Town', 'distance' => '50 km', 'time' => '1h 10m', 'price' => '$42'],
            ['route' => 'Matemwe → Nungwi', 'distance' => '25 km', 'time' => '35 min', 'price' => '$28'],
        ];

        return view('user.taxi', compact('features', 'popularRoutes', 'fleet', 'hotelTransfers'));
    }

    public function bookTaxi(Request $request)
    {
        $data = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'travel_date' => 'required|date',
            'travel_time' => 'required|string|max:20',
            'passengers' => 'required|integer|min:1|max:50',
            'vehicle_type' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:50',
        ]);

        TaxiBooking::create($data);

        return redirect()->route('taxi')->with('success', 'Your taxi request has been received. We will contact you shortly.');
    }
    public function blog()
    {
        return view('user.blog');
    }
    public function tours()
    {
        $tours = Tour::orderBy('created_at', 'desc')->get();
        return view('user.tours', compact('tours'));
    }

    public function showPackage($slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();
        return view('user.package-detail', compact('package'));
    }

    public function showTour($slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();
        return view('user.tour-detail', compact('tour'));
    }
    public function gallery()
    {
        $galleries = \App\Models\Gallery::latest()->get();
        return view('user.gallery', compact('galleries'));
    }






     public function bookTour(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'num_adults' => 'required|integer|min:1|max:50',
            'num_children' => 'required|integer|min:0|max:50',
            'special_requests' => 'nullable|string|max:1000',
            // 'terms_agreed' => 'accepted',
        ]);



        // Get the tour
        $tour = Tour::findOrFail($request->tour_id);

        // Calculate pricing




        // Generate unique booking reference
        $bookingReference = 'TR-' . strtoupper(Str::random(8)) . '-' . date('Ymd');

        // Create booking

        /**
         * Process tour booking
         */
        $booking = Booking::create([
            'booking_type' => 'tour',
            'Full_name' => $request->full_name,
            'Email' => $request->email,
            'phone' => $request->phone,
            'tour_id' => $request->tour_id,
            'package_id' => null,
            'start_date' => $request->start_date,

            'num_children' => $request->num_children,
            'num_adults' => $request->num_adults,
            'special_requests' => $request->special_requests,
            'pickup_location' => $request->pickup_location ?? null,
            'destination' => $request->destination ?? null,
            'status' => 'pending',
            'booking_reference' => $bookingReference,
            'admin_notes' => null,
        ]);

        // Send confirmation email (optional)
        // $this->sendBookingConfirmation($booking, $tour);



        return redirect()->back()
            ->with('success', 'Your tour booking has been submitted successfully!');
    }





}
