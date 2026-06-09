@extends('admin.layouts.app')

@section('title', 'Package Bookings')
@section('subtitle', 'Manage all package bookings')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-lg bg-white p-6 shadow-sm border-l-4 border-brand">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Package Bookings</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $bookings->total() }}</p>
                </div>
                <div class="rounded-full bg-brand-light p-3">
                    <svg class="h-6 w-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Package Bookings</p>
                    <p class="text-2xl font-semibold text-yellow-600">{{ $pendingCount }}</p>
                </div>
                <div class="rounded-full bg-yellow-100 p-3">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Completed Package Bookings</p>
                    <p class="text-2xl font-semibold text-green-600">{{ $bookings->where('status', 'completed')->count() }}</p>
                </div>
                <div class="rounded-full bg-green-100 p-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalRevenue, 0) }} TZS</p>
                </div>
                <div class="rounded-full bg-blue-100 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                <a href="{{ route('admin.bookings.package') }}" class="ml-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </form>
    </div>

    <!-- Export Buttons -->
    {{-- <div class="flex justify-end gap-2">
        <a href="{{ route('admin.bookings.export.excel', array_merge(request()->query(), ['booking_type' => 'package'])) }}" class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
            <svg class="inline h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m-6 4h8a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h8z"></path>
            </svg>
            Export Excel
        </a>
        <a href="{{ route('admin.bookings.export.pdf', array_merge(request()->query(), ['booking_type' => 'package'])) }}" class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">
            <svg class="inline h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
            Export PDF
        </a>
    </div> --}}

    <!-- Package Bookings Table -->
    <div class="overflow-hidden rounded-lg bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Reference</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Package</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Travel Dates</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Travelers</th>

                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Booked On</th>
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
                            <div class="font-medium text-gray-900">{{ $booking->Full_name }}</div>
                            <div class="text-xs">{{ $booking->Email }}</div>
                            @if($booking->special_requests)
                                <div class="text-xs text-brand mt-1 cursor-help" title="{{ $booking->special_requests }}">
                                    📝 Special Request
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $booking->phone ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="font-medium text-gray-900">{{ $booking->package ? $booking->package->name : 'N/A' }}</div>
                            @if($booking->package && $booking->package->duration)
                                <div class="text-xs text-gray-500">Duration: {{ $booking->package->duration }} days</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="font-medium">{{ $booking->start_date->format('M d, Y') }}</div>
                            @if($booking->end_date)
                                <div class="text-xs">to {{ $booking->end_date->format('M d, Y') }}</div>
                                <div class="text-xs text-brand">{{ $booking->start_date->diffInDays($booking->end_date) + 1 }} days</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="font-medium">{{ $booking->num_adults + $booking->num_children }} total</div>
                            <div class="text-xs">👤 {{ $booking->num_adults }} adults | 👶 {{ $booking->num_children }} children</div>
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                            <form method="POST" action="{{ route('admin.bookings.update-status', $booking->id) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()"
                                    class="text-xs rounded-md border-gray-300 focus:border-brand focus:ring-brand">
                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>📋 Pending</option>
                                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>✓ Confirmed</option>
                                    <option value="ongoing" {{ $booking->status == 'ongoing' ? 'selected' : '' }}>🔄 Ongoing</option>
                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $booking->created_at->format('M d, Y') }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-brand hover:text-brand-dark mr-3">
                                View Details
                            </a>
                            <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this package booking?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p>No package bookings found</p>
                            </div>
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
