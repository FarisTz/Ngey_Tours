@extends('admin.layouts.app')

@section('title', 'Booking Details - ' . $booking->booking_reference)
@section('subtitle', 'View complete booking information')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <a href="{{ url()->previous() }}" class="text-brand hover:text-brand-dark inline-flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
        </div>
        <div class="flex gap-2">
            <form method="POST" action="{{ route('admin.bookings.update-status', $booking->id) }}" class="inline">
                @csrf
                @method('PUT')
                <select name="status" onchange="this.form.submit()"
                    class="rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring-brand">
                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>📋 Pending</option>
                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>✓ Confirmed</option>
                    <option value="ongoing" {{ $booking->status == 'ongoing' ? 'selected' : '' }}>🔄 Ongoing</option>
                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                </select>
            </form>
            <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700" onclick="return confirm('Are you sure?')">
                    Delete Booking
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Customer & Booking Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="h-5 w-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Customer Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500">Full Name</label>
                        <p class="text-gray-900 font-medium">{{ $booking->Full_name }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Email Address</label>
                        <p class="text-gray-900">{{ $booking->Email }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs font-medium text-gray-500">Special Requests</label>
                        <p class="text-gray-700">{{ $booking->special_requests ?: 'No special requests' }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Details based on type -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    @if($booking->booking_type == 'tour')
                        <svg class="h-5 w-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($booking->booking_type == 'package')
                        <svg class="h-5 w-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                        </svg>
                    @endif
                    {{ ucfirst($booking->booking_type) }} Details
                </h3>

                @if($booking->booking_type == 'tour')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500">Tour Name</label>
                            <p class="text-gray-900 font-medium">{{ $booking->tour ? $booking->tour->name : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500">Tour Date</label>
                            <p class="text-gray-900">{{ $booking->start_date->format('F d, Y') }}</p>
                        </div>
                    </div>
                @elseif($booking->booking_type == 'package')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500">Package Name</label>
                            <p class="text-gray-900 font-medium">{{ $booking->package ? $booking->package->name : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500">Start Date</label>
                            <p class="text-gray-900">{{ $booking->start_date->format('F d, Y') }}</p>
                        </div>
                        @if($booking->end_date)
                        <div>
                            <label class="text-xs font-medium text-gray-500">End Date</label>
                            <p class="text-gray-900">{{ $booking->end_date->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500">Duration</label>
                            <p class="text-gray-900">{{ $duration }} days</p>
                        </div>
                        @endif
                    </div>
                @elseif($booking->booking_type == 'car')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500">Pickup Location</label>
                            <p class="text-gray-900">{{ $booking->pickup_location ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500">Destination</label>
                            <p class="text-gray-900">{{ $booking->destination ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500">Pickup Date</label>
                            <p class="text-gray-900">{{ $booking->start_date->format('F d, Y') }}</p>
                        </div>
                        @if($booking->end_date)
                        <div>
                            <label class="text-xs font-medium text-gray-500">Return Date</label>
                            <p class="text-gray-900">{{ $booking->end_date->format('F d, Y') }}</p>
                        </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Travelers Information -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="h-5 w-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Travelers Information
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500">Adults</label>
                        <p class="text-2xl font-bold text-gray-900">{{ $booking->num_adults }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Children</label>
                        <p class="text-2xl font-bold text-gray-900">{{ $booking->num_children }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Total Travelers</label>
                        <p class="text-2xl font-bold text-brand">{{ $booking->num_adults + $booking->num_children }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Payment & Status -->
        <div class="space-y-6">
            <!-- Booking Status Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Status</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status:</span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-800
                            @elseif($booking->status == 'ongoing') bg-purple-100 text-purple-800
                            @elseif($booking->status == 'completed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Booking Reference:</span>
                        <span class="font-mono font-semibold">{{ $booking->booking_reference }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Booking Date:</span>
                        <span>{{ $booking->created_at->format('F d, Y H:i') }}</span>
                    </div>
                </div>
            </div>

          

            <!-- Admin Notes -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Notes</h3>
                <form method="POST" action="{{ route('admin.bookings.update-status', $booking->id) }}">
                    @csrf
                    @method('PUT')
                    <textarea name="admin_notes" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring-brand mb-3"
                        placeholder="Add internal notes about this booking...">{{ $booking->admin_notes }}</textarea>
                    <button type="submit" class="w-full btn-brand rounded-lg px-4 py-2">
                        Save Notes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
