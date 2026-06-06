@extends('admin.layouts.app')

@section('title', 'Add Gallery Image')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.gallery.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Back to Gallery</a>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Add New Image</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" value="{{ old('title') }}" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
            <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
            <p class="text-sm text-gray-500 mt-1">Accepted formats: jpg, jpeg, png, webp. Max size: 2MB.</p>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                Upload Image
            </button>
        </div>
    </form>
</div>
@endsection
