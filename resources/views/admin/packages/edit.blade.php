@extends('admin.layouts.app')

@section('title', 'Edit Package')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Package</h1>
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.packages.update', $package->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title', $package->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $package->slug) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Short Description</label>
            <textarea name="short" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('short', $package->short) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Image</label>
            @if($package->image)
                <img src="/{{ $package->image }}" alt="Package Image" class="h-32 mb-2 object-cover">
            @endif
            <input type="file" name="image" class="mt-1 block w-full">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="5" required>{{ old('description', $package->description) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Highlights (one per line)</label>
            <textarea name="highlights" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="4">{{ old('highlights', is_array($package->highlights) ? implode("\n", $package->highlights) : $package->highlights) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Duration</label>
            <input type="text" name="duration" value="{{ old('duration', $package->duration) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" value="{{ old('location', $package->location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="flex justify-end">
            <a href="{{ route('admin.packages') }}" class="mr-4 text-gray-600 hover:underline" >Cancel</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md" style="background-color: #ec6905;" >Update Package</button>
        </div>
    </form>
</div>
@endsection
