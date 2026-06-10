@extends('admin.layouts.app')

@section('title', 'Admin Packages')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Packages</h1>
            <p class="text-sm text-gray-500 mt-1">Manage all package listings professionally.</p>
        </div>

        <a href="{{ route('admin.packages.create') }}"
           class="inline-flex items-center rounded-2xl px-5 py-3 text-sm font-medium text-white shadow-md transition hover:opacity-90"
           style="background-color: #ec6905;">
            + Add Package
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Package</th>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Price</th>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Location</th>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Created</th>
                        <th class="px-6 py-5 text-center text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($packages as $package)
                        <tr class="transition duration-200 hover:bg-gray-50">

                            {{-- Package --}}
                            <td class="px-6 py-5">
                                <div class="font-semibold text-gray-800">{{ Str::limit($package->title, 40) }}</div>
                                <div class="mt-1 text-xs text-gray-500">{{ $package->slug }}</div>
                            </td>

                            {{-- Price --}}
                            <td class="px-6 py-5">
                                <span class="rounded-xl bg-indigo-50 px-3 py-1 text-sm font-semibold text-indigo-700">
                                    ${{ number_format($package->price, 2) }}
                                </span>
                            </td>

                            {{-- Location --}}
                            <td class="px-6 py-5 text-gray-600">{{ Str::limit($package->location, 25) }}</td>

                            {{-- Created --}}
                            <td class="px-6 py-5 text-gray-500">{{ $package->created_at->format('M d, Y') }}</td>

                            {{-- Actions --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">

                                    <button data-id="{{ $package->id }}" data-action="view"
                                        class="action-btn rounded-xl bg-blue-600 px-4 py-2 text-xs font-medium text-white transition hover:bg-blue-700">
                                        View
                                    </button>

                                    <button data-id="{{ $package->id }}" data-action="edit"
                                        class="action-btn rounded-xl bg-amber-500 px-4 py-2 text-xs font-medium text-white transition hover:bg-amber-600">
                                        Edit
                                    </button>

                                    <button data-id="{{ $package->id }}" data-action="delete"
                                        class="action-btn rounded-xl bg-red-600 px-4 py-2 text-xs font-medium text-white transition hover:bg-red-700">
                                        Delete
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="text-lg font-semibold text-gray-700">No packages found</div>
                                    <p class="mt-1 text-sm text-gray-500">Start by adding your first package.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">
            {{ $packages->links() }}
        </div>
    </div>

</div>

{{-- Action Button Script --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const routes = {
            view:   id => `{{ route('admin.packages.show',   ':id') }}`.replace(':id', id),
            edit:   id => `{{ route('admin.packages.edit',   ':id') }}`.replace(':id', id),
            delete: id => `{{ route('admin.packages.destroy',':id') }}`.replace(':id', id),
        };

        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id     = btn.dataset.id;
                const action = btn.dataset.action;

                if (action === 'delete') {
                    if (!confirm('Are you sure you want to delete this package?')) return;
                    fetch(routes.delete(id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN':  token,
                            'Accept':        'application/json',
                            'Content-Type':  'application/json'
                        }
                    }).then(r => { if (r.ok) location.reload(); });
                } else {
                    window.location.href = routes[action](id);
                }
            });
        });
    });
</script>

@endsection