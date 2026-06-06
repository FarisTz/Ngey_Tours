@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-12">
    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl transition-shadow duration-300 hover:shadow-2xl">
            <p class="text-sm font-medium uppercase tracking-wider text-gray-500">Tours</p>
            <p class="mt-4 text-5xl font-bold text-gray-900">{{ $stats['tours'] }}</p>
            <p class="mt-2 text-sm text-gray-500">Active tour listings</p>
            <a href="{{ route('admin.tours') }}" class="mt-6 inline-flex items-center rounded-full bg-orange-500 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-orange-600">Manage Tours</a>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl transition-shadow duration-300 hover:shadow-2xl">
            <p class="text-sm font-medium uppercase tracking-wider text-gray-500">Packages</p>
            <p class="mt-4 text-5xl font-bold text-gray-900">{{ $stats['packages'] }}</p>
            <p class="mt-2 text-sm text-gray-500">Available packages</p>
            <a href="{{ route('admin.packages') }}" class="mt-6 inline-flex items-center rounded-full bg-orange-500 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-orange-600">Manage Packages</a>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl transition-shadow duration-300 hover:shadow-2xl">
            <p class="text-sm font-medium uppercase tracking-wider text-gray-500">Bookings</p>
            <p class="mt-4 text-5xl font-bold text-gray-900">{{ $stats['bookings'] }}</p>
            <p class="mt-2 text-sm text-gray-500">Recent booking requests</p>
            <button class="mt-6 inline-flex items-center rounded-full bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-green-600">View Bookings</button>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl transition-shadow duration-300 hover:shadow-2xl">
            <p class="text-sm font-medium uppercase tracking-wider text-gray-500">Taxi Routes</p>
            <p class="mt-4 text-5xl font-bold text-gray-900">{{ $stats['routes'] }}</p>
            <p class="mt-2 text-sm text-gray-500">Active taxi routes</p>
            <a href="{{ route('admin.taxi.routes') }}" class="mt-6 inline-flex items-center rounded-full bg-orange-500 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-orange-600">Manage Routes</a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl transition-shadow duration-300 hover:shadow-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Message Center</h2>
                    <p class="mt-2 text-sm text-gray-500">New conversation requests</p>
                </div>
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-orange-100 text-orange-600">12</span>
            </div>
            <div class="mt-6 space-y-4">
                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-sm font-medium text-gray-900">Hotel inquiry from James</p>
                    <p class="mt-1 text-xs text-gray-500">Sent 15 minutes ago</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-sm font-medium text-gray-900">Package question from Erika</p>
                    <p class="mt-1 text-xs text-gray-500">Sent 1 hour ago</p>
                </div>
            </div>
            <button class="mt-6 inline-flex items-center rounded-full bg-orange-500 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-orange-600">Open Messages</button>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl transition-shadow duration-300 hover:shadow-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Contact Requests</h2>
                    <p class="mt-2 text-sm text-gray-500">Customer contact submissions</p>
                </div>
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-orange-100 text-orange-600">9</span>
            </div>
            <div class="mt-6 space-y-4">
                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-sm font-medium text-gray-900">Need invoice details</p>
                    <p class="mt-1 text-xs text-gray-500">From Ali</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-sm font-medium text-gray-900">Booking follow-up needed</p>
                    <p class="mt-1 text-xs text-gray-500">From Zara</p>
                </div>
            </div>
            <button class="mt-6 inline-flex items-center rounded-full bg-orange-500 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-orange-600">Open Contacts</button>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl transition-shadow duration-300 hover:shadow-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Notifications</h2>
                    <p class="mt-2 text-sm text-gray-500">System and admin alerts</p>
                </div>
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-orange-100 text-orange-600">4</span>
            </div>
            <div class="mt-6 space-y-4">
                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-sm font-medium text-gray-900">New package created</p>
                    <p class="mt-1 text-xs text-gray-500">Today</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-sm font-medium text-gray-900">Server health check completed</p>
                    <p class="mt-1 text-xs text-gray-500">Today</p>
                </div>
            </div>
            <button class="mt-6 inline-flex items-center rounded-full bg-orange-500 px-4 py-2 text-sm font-medium text-white shadow-md transition hover:bg-orange-600">View Notifications</button>
        </div>
    </div>
</div>
@endsection
