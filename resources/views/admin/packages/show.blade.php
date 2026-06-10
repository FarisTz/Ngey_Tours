@extends('admin.layouts.app')

@section('title', 'Package Details')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $package->title }}</h1>
        <a href="{{ route('admin.packages') }}"
           class="rounded-xl bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 text-sm font-medium" style="background-color: #ec6905;">
            Back
        </a>
        <a href="{{ route('admin.packages.edit', $package->id) }}"
           class="rounded-xl bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 text-sm font-medium">
            Edit
        </a>
    </div>

    {{-- Image (if exists) --}}
    @if(!empty($package->image))
        <div class="mb-6">
            <img src="/{{ $package->image }}" alt="{{ $package->title }}" class="w-full rounded-lg shadow" />
        </div>
    @endif

    {{-- Description --}}
    <div class="mb-4 text-gray-700">
        {{ $package->description }}
    </div>

    {{-- Highlights (if any) --}}
    @if($package->highlights && is_array($package->highlights))
        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-2 text-gray-800">Highlights</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($package->highlights as $highlight)
                    @if(trim($highlight))
                        <li>{{ $highlight }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @elseif($package->highlights)
        {{-- When stored as a string, split by new lines --}}
        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-2 text-gray-800">Highlights</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach(explode('\n', $package->highlights) as $highlight)
                    @if(trim($highlight))
                        <li>{{ $highlight }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Meta Information --}}
    <div class="grid grid-cols-2 gap-4 mt-6 text-gray-600">
        <div><strong>Price:</strong> ${{ number_format($package->price, 2) }}</div>
        <div><strong>Location:</strong> {{ $package->location }}</div>
        <div><strong>Created:</strong> {{ $package->created_at->format('M d, Y') }}</div>
    </div>
</div>
@endsection
