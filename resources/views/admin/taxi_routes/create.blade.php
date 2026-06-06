@extends('admin.layouts.app')

@section('title', 'Add Taxi Route')
@section('subtitle', 'Create a new taxi route for the booking page.')

@section('content')
<div class="max-w-3xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('admin.taxi.routes.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Pickup Location</label>
            <input type="text" name="pickup_location" value="{{ old('pickup_location') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" required>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Destination</label>
            <input type="text" name="destination" value="{{ old('destination') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" required>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Distance</label>
                <input type="text" name="distance" value="{{ old('distance') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" placeholder="e.g. 10 km" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Duration</label>
                <input type="text" name="duration" value="{{ old('duration') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" placeholder="e.g. 25 min" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Price</label>
                <input type="text" name="price" value="{{ old('price') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" placeholder="e.g. $15" required>
            </div>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
            <select name="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900">
                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center rounded-full bg-slate-950 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-slate-800">Save Route</button>
        </div>
    </form>
</div>
@endsection
