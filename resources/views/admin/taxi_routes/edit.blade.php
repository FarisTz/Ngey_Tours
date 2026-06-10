@extends('admin.layouts.app')

@section('title', 'Edit Taxi Route')
@section('subtitle', 'Modify route details')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-sm">
    <h2 class="text-2xl font-semibold mb-4">Edit Taxi Route</h2>
    <form action="{{ route('admin.taxi.routes.update', $route->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700">Pickup Location</label>
            <input type="text" name="pickup_location" value="{{ old('pickup_location', $route->pickup_location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Destination</label>
            <input type="text" name="destination" value="{{ old('destination', $route->destination) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Distance (km)</label>
                <input type="number" step="0.01" name="distance" value="{{ old('distance', $route->distance) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Duration (mins)</label>
                <input type="number" step="1" name="duration" value="{{ old('duration', $route->duration) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required />
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Price (USD)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $route->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="active" {{ $route->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $route->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex items-center space-x-4 mt-6">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"style="background-color: #F96D00;">Save</button>
            <a href="{{ route('admin.taxi.routes') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400" style="background-color: #F96D00; color: white;">Cancel</a>
        </div>
    </form>
</div>
@endsection
