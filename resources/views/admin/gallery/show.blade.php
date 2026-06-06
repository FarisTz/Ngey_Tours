@extends('admin.layouts.app')

@section('title', 'View Gallery Image')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.gallery.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Back to Gallery</a>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">{{ $gallery->title }}</h2>
        <div>
            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
            </form>
        </div>
    </div>

    <div class="flex justify-center bg-gray-100 p-4 rounded border border-gray-200">
        <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="max-w-full h-auto rounded shadow-sm">
    </div>
    
    <div class="mt-6 text-sm text-gray-600">
        <p><strong>Uploaded at:</strong> {{ $gallery->created_at->format('M d, Y H:i:A') }}</p>
        <p><strong>Last updated:</strong> {{ $gallery->updated_at->format('M d, Y H:i:A') }}</p>
    </div>
</div>
@endsection
