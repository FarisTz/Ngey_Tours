@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <div class="grid gap-6 xl:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">Tours</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $stats['tours'] }}</p>
            <p class="mt-2 text-sm text-slate-500">Active tour listings</p>
            <a href="{{ route('admin.tours') }}" class="mt-6 inline-flex items-center rounded-full bg-slate-950 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-800">Manage Tours</a>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">Packages</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $stats['packages'] }}</p>
            <p class="mt-2 text-sm text-slate-500">Available packages</p>
            <a href="{{ route('admin.packages') }}" class="mt-6 inline-flex items-center rounded-full bg-slate-950 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-800">Manage Packages</a>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">Bookings</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $stats['bookings'] }}</p>
            <p class="mt-2 text-sm text-slate-500">Recent booking requests</p>
            <button class="mt-6 inline-flex items-center rounded-full bg-emerald-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-600">View Bookings</button>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-slate-500">Notifications</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $stats['notifications'] }}</p>
            <p class="mt-2 text-sm text-slate-500">System alerts & updates</p>
            <button class="mt-6 inline-flex items-center rounded-full bg-slate-950 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-800">View Alerts</button>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Message Center</h2>
                    <p class="mt-2 text-sm text-slate-500">New conversation requests</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">12</span>
            </div>
            <div class="mt-6 space-y-3">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-medium text-slate-900">Hotel inquiry from James</p>
                    <p class="mt-1 text-xs text-slate-500">Sent 15 minutes ago</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-medium text-slate-900">Package question from Erika</p>
                    <p class="mt-1 text-xs text-slate-500">Sent 1 hour ago</p>
                </div>
            </div>
            <button class="mt-6 inline-flex items-center rounded-full bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Open Messages</button>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Contact Requests</h2>
                    <p class="mt-2 text-sm text-slate-500">Customer contact submissions</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">9</span>
            </div>
            <div class="mt-6 space-y-3">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-medium text-slate-900">Need invoice details</p>
                    <p class="mt-1 text-xs text-slate-500">From Ali</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-medium text-slate-900">Booking follow-up needed</p>
                    <p class="mt-1 text-xs text-slate-500">From Zara</p>
                </div>
            </div>
            <button class="mt-6 inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">Open Contacts</button>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Notifications</h2>
                    <p class="mt-2 text-sm text-slate-500">System and admin alerts</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-100 text-rose-700">4</span>
            </div>
            <div class="mt-6 space-y-3">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-medium text-slate-900">New package created</p>
                    <p class="mt-1 text-xs text-slate-500">Today</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-medium text-slate-900">Server health check completed</p>
                    <p class="mt-1 text-xs text-slate-500">Today</p>
                </div>
            </div>
            <button class="mt-6 inline-flex items-center rounded-full bg-rose-600 px-4 py-2 text-sm font-medium text-white hover:bg-rose-700">View Notifications</button>
        </div>
    </div>
</div>
@endsection