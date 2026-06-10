@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">{{ $tour->title }}</h1>
    @if($tour->image)
        <img src="{{ asset($tour->image) }}" alt="{{ $tour->title }}" class="mb-4 rounded-lg w-full max-w-3xl">
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <h2 class="text-xl font-semibold mb-2">Description</h2>
            <p class="text-gray-700">{{ $tour->description }}</p>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-2">Details</h2>
            <ul class="list-disc list-inside text-gray-700">
                <li><strong>Price:</strong> ${{ $tour->price }}</li>
                <li><strong>Duration:</strong> {{ $tour->duration }}</li>
                <li><strong>Location:</strong> {{ $tour->location }}</li>
                <li><strong>Created At:</strong> {{ $tour->created_at->format('M d, Y') }}</li>
            </ul>
        </div>
    </div>
    @if($tour->highlights)
        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-2">Highlights</h2>
            @php
    $highlights = is_array($tour->highlights) ? $tour->highlights : explode("\n", $tour->highlights);
@endphp
<ul class="list-disc list-inside text-gray-700">
                @foreach($highlights as $highlight)
                    @if(trim($highlight))
                        <li>{{ $highlight }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mt-6 flex space-x-4">
        <a href="{{ route('admin.tours.edit', $tour->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
        <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tour?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
        </form>
        <a href="{{ route('admin.tours') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Back to List</a>
    </div>
</div>
@endsection
