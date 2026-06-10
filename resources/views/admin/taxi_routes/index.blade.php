@extends('admin.layouts.app')
@section('title', 'Taxi Routes')
@section('subtitle', 'Manage route fares and destinations for taxi bookings.')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Taxi Routes</h2>
            <p class="mt-2 text-sm text-slate-500">View and add route details for airport and hotel transfers.</p>
        </div>
        <a href="{{ route('admin.taxi.routes.create') }}" class="inline-flex items-center rounded-full bg-slate-950 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-800" style="background-color: #ec6905ff;">Create Route</a>
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-900">
                <tr>
                    <th class="px-6 py-4 font-semibold uppercase">Pickup</th>
                    <th class="px-6 py-4 font-semibold uppercase">Destination</th>
                    <th class="px-6 py-4 font-semibold uppercase">Distance</th>
                    <th class="px-6 py-4 font-semibold uppercase">Duration</th>
                    <th class="px-6 py-4 font-semibold uppercase">Price</th>
                    <th class="px-6 py-4 font-semibold uppercase">Status</th>
                    <th class="px-6 py-4 font-semibold uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($routes as $route)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">{{ $route->pickup_location }}</td>
                        <td class="px-6 py-4">{{ $route->destination }}</td>
                        <td class="px-6 py-4">{{ $route->distance }}</td>
                        <td class="px-6 py-4">{{ $route->duration }}</td>
                        <td class="px-6 py-4">{{ $route->price }}</td>
                        <td class="px-6 py-4">{{ ucfirst($route->status) }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.taxi.routes.edit', $route->id) }}" class="inline-flex items-center px-3 py-1 text-sm text-white bg-indigo-600 rounded">Edit</a>
                            <form action="{{ route('admin.taxi.routes.destroy', $route->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this route?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 ml-2 text-sm text-white bg-red-600 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">No taxi routes available yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
