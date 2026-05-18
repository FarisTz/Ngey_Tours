<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'tours' => Tour::count(),
            'packages' => Package::count(),
            'bookings' => Booking::count(),
            'notifications' => Notification::count(),
        ];

        $packages = Package::orderBy('created_at', 'desc')->get();

        return view('admin.index', compact('stats', 'packages'));
    }

    public function tours()
    {
        $tours = Tour::orderBy('created_at', 'desc')->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function createTour()
    {
        return view('admin.tours.create');
    }

    public function storeTour(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:tours,slug',
            'title' => 'required|string|max:255',
            'short' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'description' => 'required|string',
            'highlights' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $data['highlights'] = $data['highlights'] ? array_filter(array_map('trim', explode('\n', $data['highlights']))) : [];

        Tour::create($data);

        return redirect()->route('admin.tours')->with('success', 'Tour created successfully.');
    }

    public function packages()
    {
        $packages = Package::orderBy('created_at', 'desc')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function createPackage()
    {
        return view('admin.packages.create');
    }

    public function storePackage(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:packages,slug',
            'title' => 'required|string|max:255',
            'short' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'description' => 'required|string',
            'highlights' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $data['highlights'] = $data['highlights'] ? array_filter(array_map('trim', explode('\n', $data['highlights']))) : [];

        Package::create($data);

        return redirect()->route('admin.packages')->with('success', 'Package created successfully.');
    }
}