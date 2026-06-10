@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h1>
    @if (session('status'))
        <div class="mb-4 rounded bg-green-100 p-3 text-green-800">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" name="current_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('current_password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>
        <div class="flex items-center space-x-4">
            <button type="submit" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Save Changes</button>
            <button type="button" id="deleteAccountBtn" class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">Delete Account</button>
        </div>
    </form>
    <form id="deleteForm" method="POST" action="{{ route('admin.profile.destroy') }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
<script>
    document.getElementById('deleteAccountBtn')?.addEventListener('click', function(){
        if(confirm('Are you sure you want to delete your account? This action cannot be undone.')){
            document.getElementById('deleteForm').submit();
        }
    });
</script>
@endsection
