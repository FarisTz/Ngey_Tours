@extends('admin.layouts.app')

@section('title', 'Admin Tours')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Tours</h1>
            <p class="text-gray-500 text-sm">Manage all available tours.</p>
        </div>

        <a href="{{ route('admin.tours.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">
            + Add Tour
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <!-- Responsive -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <!-- Head -->
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Location</th>
                        <th class="px-6 py-4">Created</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="divide-y divide-gray-200">

                    @forelse($tours as $tour)

                    <tr class="hover:bg-gray-50 transition">

                        <!-- Title -->
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">
                                {{ Str::limit($tour->title, 35) }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $tour->slug }}
                            </div>
                        </td>

                        <!-- Price -->
                        <td class="px-6 py-4 text-gray-700">
                            ${{ number_format($tour->price, 2) }}
                        </td>

                        <!-- Location -->
                        <td class="px-6 py-4 text-gray-600">
                            {{ Str::limit($tour->location, 25) }}
                        </td>

                        <!-- Created -->
                        <td class="px-6 py-4 text-gray-500">
                            {{ $tour->created_at->format('M d, Y') }}
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                               <!-- View -->
                                    <a href="#"
                                       class="rounded-xl border border-blue-200 bg-blue-600 px-4 py-2 text-xs font-medium text-white transition hover:bg-blue-700">

                                        View

                                    </a>
                                <!-- Edit -->
                                    <a href="#"
                                       class="rounded-xl border border-yellow-200 bg-yellow-500 px-4 py-2 text-xs font-medium text-white  transition hover:bg-yellow-600" style="background-color: orange">
                                            
                                        Edit

                                    </a>


                                <!-- Delete -->
                                <form action="#"
                                      method="POST"
                                      onsubmit="return confirmDelete()">

                                    @csrf
                                    @method('DELETE')

                                      <!-- Delete -->
                                    <a href="#"
                                       class="rounded-xl border border-red-200 bg-red-600 px-4 py-2 text-xs font-medium text-white transition hover:bg-red-700">

                                        Delete

                                    </a>
                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No tours found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- JavaScript -->
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this tour?');
    }
</script>

@endsection