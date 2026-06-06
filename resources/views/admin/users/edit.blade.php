@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<h1 class="text-2xl font-semibold text-gray-900 mb-6">Edit User: {{ $user->name }}</h1>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white shadow-md rounded-lg p-8">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password (optional)</label>
            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current password.</p>
        </div>
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                Update User
            </button>
            <a href="{{ route('admin.users.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
