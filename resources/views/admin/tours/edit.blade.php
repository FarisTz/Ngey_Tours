@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Tour: {{ $tour->title }}</h1>
    <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium mb-1" for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $tour->title) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1" for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $tour->slug) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1" for="short">Short Description</label>
            <textarea name="short" id="short" rows="2" class="w-full border rounded px-3 py-2">{{ old('short', $tour->short) }}</textarea>
        </div>
        <div>
            <label class="block font-medium mb-1" for="description">Description</label>
            <textarea name="description" id="description" rows="5" class="w-full border rounded px-3 py-2" required>{{ old('description', $tour->description) }}</textarea>
        </div>
        <div>
            <label class="block font-medium mb-1" for="highlights">Highlights (one per line)</label>
            <textarea name="highlights" id="highlights" rows="4" class="w-full border rounded px-3 py-2">{{ old('highlights', is_array($tour->highlights) ? implode("\n", $tour->highlights) : $tour->highlights) }}</textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1" for="price">Price</label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $tour->price) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1" for="duration">Duration</label>
                <input type="text" name="duration" id="duration" value="{{ old('duration', $tour->duration) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block font-medium mb-1" for="location">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $tour->location) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1" for="image">Image (optional)</label>
            @if($tour->image)
                <div class="mb-2">
                    <img src="{{ asset($tour->image) }}" alt="{{ $tour->title }}" class="h-32 object-cover rounded">
                </div>
            @endif
            <input type="file" name="image" id="image" class="w-full">
        </div>
        <div class="flex space-x-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Tour</button>
            <a href="{{ route('admin.tours.show', $tour->id) }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>
@endsection
