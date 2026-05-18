@extends('admin.layouts.app')

@section('title', 'Create Package')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Create Package</h1>
        <p class="mt-1 text-sm text-gray-600">Add a new package for the destination page.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-700">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.packages.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input name="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input name="slug" value="{{ old('slug') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Short description</label>
            <input name="short" value="{{ old('short') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Image path</label>
            <input name="image" value="{{ old('image') }}" placeholder="images/destination-1.jpg" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Price</label>
            <input name="price" value="{{ old('price') }}" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-700">Duration</label>
                <input name="duration" value="{{ old('duration') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input name="location" value="{{ old('location') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Highlights (one per line)</label>
            <textarea name="highlights" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('highlights') }}</textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Save Package</button>
        </div>
    </form>
</div>
@endsection
