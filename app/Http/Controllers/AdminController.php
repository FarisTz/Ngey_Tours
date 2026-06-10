<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Package;
use App\Models\TaxiRoute;
use App\Models\TaxiVehicle;
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
            'routes' => TaxiRoute::count(),
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
        $packages = Package::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.packages.index', compact('packages'));
    }

    public function createPackage()
    {
        return view('admin.packages.create');
    }

    // Show a specific package
    public function showPackage(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    // Edit a specific package
    public function editPackage(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    // Update a specific package
    public function updatePackage(Request $request, Package $package)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:packages,slug,' . $package->id,
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
        $package->update($data);

        return redirect()->route('admin.packages')->with('success', 'Package updated successfully.');
    }

    // Delete a specific package
    public function destroyPackage(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages')->with('success', 'Package deleted successfully.');
    }

    public function taxiRoutes()
    {
        $routes = TaxiRoute::orderBy('pickup_location')->orderBy('destination')->get();
        return view('admin.taxi_routes.index', compact('routes'));
    }

    public function createTaxiRoute()
    {
        return view('admin.taxi_routes.create');
    }

    public function storeTaxiRoute(Request $request)
    {
        $data = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'price' => 'required|string|max:50',
            'status' => 'required|string|in:active,inactive',
        ]);

        TaxiRoute::create($data);

        return redirect()->route('admin.taxi.routes')->with('success', 'Taxi route created successfully.');
    }

    public function taxiVehicles()
    {
        $vehicles = TaxiVehicle::orderBy('name')->get();
        return view('admin.taxi_vehicles.index', compact('vehicles'));
    }

    public function createTaxiVehicle()
    {
        return view('admin.taxi_vehicles.create');
    }

    public function storeTaxiVehicle(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:taxi_vehicles,name',
            'capacity' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'image' => 'nullable|image|file|max:2048',
            'status' => 'required|string|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $image->getClientOriginalName());
            if (!File::exists(public_path('images/vehicles'))) {
                File::makeDirectory(public_path('images/vehicles'), 0755, true);
            }
            $image->move(public_path('images/vehicles'), $imageName);
            $data['image'] = 'images/vehicles/' . $imageName;
        }

        TaxiVehicle::create($data);

        return redirect()->route('admin.taxi.vehicles')->with('success', 'Vehicle added successfully.');
    }

    public function showTaxiVehicle(TaxiVehicle $vehicle)
    {
        return response()->json($vehicle);
    }

    public function updateTaxiVehicle(Request $request, TaxiVehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:taxi_vehicles,name,' . $vehicle->id,
            'capacity' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'image' => 'nullable|image|file|max:2048',
            'status' => 'required|string|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $image->getClientOriginalName());
            if (!File::exists(public_path('images/vehicles'))) {
                File::makeDirectory(public_path('images/vehicles'), 0755, true);
            }
            $image->move(public_path('images/vehicles'), $imageName);
            $data['image'] = 'images/vehicles/' . $imageName;
        }

        $vehicle->update($data);

        return response()->json(['message' => 'Vehicle updated successfully.', 'vehicle' => $vehicle]);
    }

    public function destroyTaxiVehicle(TaxiVehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json(['message' => 'Vehicle deleted successfully.']);
    }
    
    // Show a specific tour in admin
    public function showTour(Tour $tour)
    {
        return view('admin.tours.show', compact('tour'));
    }

    // Edit a specific tour in admin
    public function editTour(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    // Update a specific tour
    public function updateTour(Request $request, Tour $tour)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:tours,slug,' . $tour->id,
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
        $tour->update($data);
        return redirect()->route('admin.tours')->with('success', 'Tour updated successfully.');
    }

    // Delete a specific tour
    public function destroyTour(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('admin.tours')->with('success', 'Tour deleted successfully.');
    }

    }



