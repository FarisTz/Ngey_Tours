@extends('admin.layouts.app')

@section('title', 'Add Taxi Vehicle')
@section('subtitle', 'Create a new vehicle for your fleet.')

@section('content')
<div class="max-w-3xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('admin.taxi.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Vehicle Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Toyota Alphard" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" required>
            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Capacity</label>
            <input type="text" name="capacity" value="{{ old('capacity') }}" placeholder="e.g. 1–6 Passengers" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" required>
            @error('capacity')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Vehicle Type</label>
            <input type="text" name="type" value="{{ old('type') }}" placeholder="e.g. Luxury Transfer" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" required>
            @error('type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Tag/Feature</label>
            <input type="text" name="tag" value="{{ old('tag') }}" placeholder="e.g. Air Conditioning" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900" required>
            @error('tag')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Vehicle Image</label>
            <input type="file" name="image" accept="image/*" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900">
            @error('image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
            <select name="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900">
                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.taxi.vehicles') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">Cancel</a>
            <button type="submit" class="inline-flex items-center rounded-full bg-slate-950 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-slate-800">Add Vehicle</button>
        </div>
    </form>
</div>
@endsection
