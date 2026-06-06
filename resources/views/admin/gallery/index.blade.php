@extends('admin.layouts.app')

@section('title', 'Gallery Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Gallery Management</h1>
    <a href="{{ route('admin.gallery.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full">
        Add Image
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Image
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Title
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($galleries as $gallery)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-20 h-20 object-cover rounded">
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $gallery->title }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('admin.gallery.show', $gallery->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                        <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        No images found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
