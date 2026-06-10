@extends('admin.layouts.app')

@section('title', 'All Bookings')
@section('subtitle', 'Manage all bookings across tours, packages, and car rentals')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
        <div class="rounded-lg bg-white p-6 shadow-sm border-l-4 border-brand">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $bookings->total() }}</p>
                </div>
                <div class="rounded-full bg-brand-light p-3">
                    <svg class="h-6 w-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="rounded-lg bg-white p-4 shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Reference, name or email..."
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring-brand">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring-brand">
                    <option value="">All</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select name="booking_type" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring-brand">
                    <option value="">All</option>
                    @foreach($bookingTypes as $type)
                        <option value="{{ $type }}" {{ request('booking_type') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring-brand">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-brand focus:ring-brand">
            </div>

            <div class="flex items-end">
                <button type="submit" class="btn-brand rounded-lg px-4 py-2">Filter</button>
                <a href="{{ route('admin.bookings.all') }}" class="ml-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </form>
    </div>

    <!-- Export Buttons -->
    {{-- <div class="flex justify-end gap-2">
        <a href="{{ route('admin.bookings.export.excel', request()->query()) }}" class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
            Export Excel
        </a>
        <a href="{{ route('admin.bookings.export.pdf', request()->query()) }}" class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">
            Export PDF
        </a>
    </div> --}}

    <!-- Bookings Table -->
    <div class="overflow-hidden rounded-lg bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Reference</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Dates</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Guests</th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $booking->booking_reference }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="font-medium text-gray-900">{{ $booking->full_name }}</div>
                            <div class="text-xs">{{ $booking->email }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                            <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5
                                @if($booking->booking_type == 'tour') bg-blue-100 text-blue-800
                                @elseif($booking->booking_type == 'package') bg-green-100 text-green-800
                                @else bg-purple-100 text-purple-800
                                @endif">
                                {{ ucfirst($booking->booking_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $booking->phone ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div>{{ $booking->start_date->format('M d, Y') }}</div>
                            @if($booking->end_date)
                                <div class="text-xs">to {{ $booking->end_date->format('M d, Y') }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $booking->num_adults + $booking->num_children }} total
                            <div class="text-xs">({{ $booking->num_adults }} adults, {{ $booking->num_children }} children)</div>
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                            <form method="POST" action="{{ route('admin.bookings.update-status', $booking->id) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()"
                                    class="text-xs rounded-md border-gray-300 focus:border-brand focus:ring-brand">
                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="ongoing" {{ $booking->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-brand hover:text-brand-dark mr-3">View</a>
                            <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                            No bookings found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
