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
           class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded-lg shadow-lg" style="background-color: #ec6905ff;">
            + Add Tour
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 bg-teal-100 border border-teal-300 text-teal-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden">

        <!-- Responsive -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <!-- Head -->
                <thead class="bg-gray-200 text-gray-800 uppercase text-sm">
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

                    <tr class="hover:bg-gray-100 transition-colors">

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
                                <button data-id="{{ $tour->id }}" data-action="view" class="action-btn view-btn rounded-xl border border-blue-200 bg-blue-600 px-4 py-2 text-xs font-medium text-white hover:bg-blue-700">View</button>
                                <button data-id="{{ $tour->id }}" data-action="edit" class="action-btn edit-btn rounded-xl border border-yellow-200 bg-amber-500 px-4 py-2 text-xs font-medium text-white hover:bg-amber-600">Edit</button>
                                <button data-id="{{ $tour->id }}" data-action="delete" class="action-btn delete-btn rounded-xl border border-red-200 bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700">Delete</button>
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
    document.addEventListener('DOMContentLoaded', () => {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        const token = tokenMeta ? tokenMeta.getAttribute('content') : '';
        const routes = {
            view: id => `{{ route('admin.tours.show', ':id') }}`.replace(':id', id),
            edit: id => `{{ route('admin.tours.edit', ':id') }}`.replace(':id', id),
            delete: id => `{{ route('admin.tours.destroy', ':id') }}`.replace(':id', id)
        };
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const action = btn.dataset.action;
                if (action === 'delete') {
                    if (!confirm('Are you sure you want to delete this tour?')) return;
                    fetch(routes.delete(id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).then(r => {
                        if (r.ok) location.reload();
                    });
                } else {
                    window.location.href = routes[action](id);
                }
            });
        });
    });
</script>

@endsection