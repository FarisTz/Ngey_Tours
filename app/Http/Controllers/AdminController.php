<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'image' => 'nullable|file|max:2048',
            'description' => 'required|string',
            'highlights' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $image->getClientOriginalName());
            if (!File::exists(public_path('images/tours'))) {
                File::makeDirectory(public_path('images/tours'), 0755, true);
            }
            $image->move(public_path('images/tours'), $imageName);
            $data['image'] = 'images/tours/' . $imageName;
        }

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
            'image' => 'nullable|file|max:2048',
            'description' => 'required|string',
            'highlights' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $image->getClientOriginalName());
            if (!File::exists(public_path('images/packages'))) {
                File::makeDirectory(public_path('images/packages'), 0755, true);
            }
            $image->move(public_path('images/packages'), $imageName);
            $data['image'] = 'images/packages/' . $imageName;
        }

        $data['highlights'] = $data['highlights'] ? array_filter(array_map('trim', explode('\n', $data['highlights']))) : [];

        Package::create($data);

        return redirect()->route('admin.packages')->with('success', 'Package created successfully.');
    }
}
