@extends('admin.layouts.app')

@section('title', 'Taxi Vehicles')
@section('subtitle', 'Manage your fleet of taxi vehicles.')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Taxi Vehicles</h2>
            <p class="mt-2 text-sm text-gray-500">Add and manage your fleet vehicles with images and details.</p>
        </div>
        <a href="{{ route('admin.taxi.vehicles.create') }}" class="inline-flex items-center rounded-full bg-orange-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-orange-700 transition">Add Vehicle</a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($vehicles as $vehicle)
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                @if($vehicle->image)
                    <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}" class="h-48 w-full object-cover">
                @else
                    <div class="h-48 w-full bg-gray-100 flex items-center justify-center text-gray-400">No image</div>
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $vehicle->name }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $vehicle->capacity }}</p>
                    <p class="mt-1 text-xs text-gray-600"><strong>Type:</strong> {{ $vehicle->type }}</p>
                    <p class="mt-1 text-xs text-gray-600"><strong>Tag:</strong> {{ $vehicle->tag }}</p>
                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <span class="inline-flex rounded-full px-2 py-1 text-xs font-medium {{ $vehicle->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <button type="button" class="view-vehicle-btn inline-flex items-center rounded-full border border-orange-200 bg-white px-3 py-2 text-xs font-medium text-orange-600 shadow-sm hover:bg-orange-50" data-id="{{ $vehicle->id }}">View</button>
                        <button type="button" class="edit-vehicle-btn inline-flex items-center rounded-full border border-orange-200 bg-white px-3 py-2 text-xs font-medium text-orange-600 shadow-sm hover:bg-orange-50" data-id="{{ $vehicle->id }}">Edit</button>
                        <button type="button" class="delete-vehicle-btn inline-flex items-center rounded-full bg-rose-500 px-3 py-2 text-xs font-medium text-white shadow-sm hover:bg-rose-600" data-id="{{ $vehicle->id }}">Delete</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-gray-200 bg-white p-8 text-center">
                <p class="text-gray-500">No vehicles added yet.</p>
            </div>
        @endforelse
    </div>
</div>

<div id="vehicle-view-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-8">
    <div class="mx-auto w-full max-w-2xl rounded-3xl bg-white p-6 shadow-2xl">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-xl font-semibold text-gray-900">Vehicle Details</h2>
            <button type="button" id="close-view-modal" class="text-gray-500 hover:text-gray-900">Close</button>
        </div>
        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <div>
                <div id="view-image" class="h-56 overflow-hidden rounded-3xl bg-gray-100"></div>
            </div>
            <div class="space-y-3">
                <p><strong>Name:</strong> <span id="view-name"></span></p>
                <p><strong>Capacity:</strong> <span id="view-capacity"></span></p>
                <p><strong>Type:</strong> <span id="view-type"></span></p>
                <p><strong>Tag:</strong> <span id="view-tag"></span></p>
                <p><strong>Status:</strong> <span id="view-status" class="inline-flex rounded-full px-2 py-1 text-xs font-medium"></span></p>
            </div>
        </div>
    </div>
</div>

<div id="vehicle-edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-8">
    <div class="mx-auto w-full max-w-2xl rounded-3xl bg-white p-6 shadow-2xl">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-xl font-semibold text-gray-900">Edit Vehicle</h2>
            <button type="button" id="close-edit-modal" class="text-gray-500 hover:text-gray-900">Close</button>
        </div>
        <form id="vehicle-edit-form" class="mt-6 space-y-4" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="edit-name" class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Capacity</label>
                <input type="text" name="capacity" id="edit-capacity" class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Type</label>
                <input type="text" name="type" id="edit-type" class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Tag</label>
                <input type="text" name="tag" id="edit-tag" class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="edit-status" class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" id="edit-image" accept="image/*" class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" id="cancel-edit" class="inline-flex items-center rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Cancel</button>
                <button type="submit" class="inline-flex items-center rounded-full bg-orange-600 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-orange-700 transition">Save Changes</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const baseUrl = '/admin/taxi-vehicles';
        let activeVehicleId = null;

        const viewModal = document.getElementById('vehicle-view-modal');
        const editModal = document.getElementById('vehicle-edit-modal');
        const viewName = document.getElementById('view-name');
        const viewCapacity = document.getElementById('view-capacity');
        const viewType = document.getElementById('view-type');
        const viewTag = document.getElementById('view-tag');
        const viewStatus = document.getElementById('view-status');
        const viewImage = document.getElementById('view-image');
        const editForm = document.getElementById('vehicle-edit-form');
        const editName = document.getElementById('edit-name');
        const editCapacity = document.getElementById('edit-capacity');
        const editType = document.getElementById('edit-type');
        const editTag = document.getElementById('edit-tag');
        const editStatus = document.getElementById('edit-status');
        const editImage = document.getElementById('edit-image');

        const closeViewModal = document.getElementById('close-view-modal');
        const closeEditModal = document.getElementById('close-edit-modal');
        const cancelEdit = document.getElementById('cancel-edit');

        const toggleModal = (modal, visible) => {
            modal.classList.toggle('hidden', !visible);
            modal.classList.toggle('flex', visible);
        };

        const formatStatusLabel = (status) => {
            viewStatus.textContent = status.charAt(0).toUpperCase() + status.slice(1);
            viewStatus.className = 'inline-flex rounded-full px-2 py-1 text-xs font-medium ' + (status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700');
        };

        const refreshCard = (vehicle) => {
            const card = document.querySelector(`[data-id="${vehicle.id}"]`).closest('.overflow-hidden');
            if (!card) return;
            card.querySelector('h3').textContent = vehicle.name;
            card.querySelector('.text-sm.text-slate-500').textContent = vehicle.capacity;
            const typeEl = card.querySelectorAll('.text-xs.text-slate-600')[0];
            const tagEl = card.querySelectorAll('.text-xs.text-slate-600')[1];
            typeEl.innerHTML = `<strong>Type:</strong> ${vehicle.type}`;
            tagEl.innerHTML = `<strong>Tag:</strong> ${vehicle.tag}`;
            const statusEl = card.querySelector('.inline-flex.rounded-full.px-2');
            statusEl.textContent = vehicle.status.charAt(0).toUpperCase() + vehicle.status.slice(1);
            statusEl.className = 'inline-flex rounded-full px-2 py-1 text-xs font-medium ' + (vehicle.status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700');
            if (vehicle.image) {
                const img = card.querySelector('img') || document.createElement('img');
                img.src = vehicle.image;
                img.alt = vehicle.name;
                img.className = 'h-48 w-full object-cover';
                if (!card.querySelector('img')) {
                    card.querySelector('.h-48').replaceWith(img);
                }
            }
        };

        const removeCard = (id) => {
            const button = document.querySelector(`[data-id="${id}"]`);
            if (!button) return;
            const card = button.closest('.overflow-hidden');
            if (card) card.remove();
        };

        const loadVehicle = async (id) => {
            const response = await fetch(`${baseUrl}/${id}`, {
                headers: { 'Accept': 'application/json' },
            });
            if (!response.ok) throw new Error('Unable to load vehicle');
            return await response.json();
        };

        document.addEventListener('click', async (event) => {
            if (event.target.matches('.view-vehicle-btn')) {
                activeVehicleId = event.target.dataset.id;
                try {
                    const vehicle = await loadVehicle(activeVehicleId);
                    viewName.textContent = vehicle.name;
                    viewCapacity.textContent = vehicle.capacity;
                    viewType.textContent = vehicle.type;
                    viewTag.textContent = vehicle.tag;
                    formatStatusLabel(vehicle.status);
                    viewImage.innerHTML = vehicle.image ? `<img src="${vehicle.image}" alt="${vehicle.name}" class="h-full w-full object-cover">` : '<div class="h-full w-full bg-slate-100 flex items-center justify-center text-slate-400">No image</div>';
                    toggleModal(viewModal, true);
                } catch (error) {
                    alert(error.message);
                }
            }

            if (event.target.matches('.edit-vehicle-btn')) {
                activeVehicleId = event.target.dataset.id;
                try {
                    const vehicle = await loadVehicle(activeVehicleId);
                    editName.value = vehicle.name;
                    editCapacity.value = vehicle.capacity;
                    editType.value = vehicle.type;
                    editTag.value = vehicle.tag;
                    editStatus.value = vehicle.status;
                    editImage.value = '';
                    toggleModal(editModal, true);
                } catch (error) {
                    alert(error.message);
                }
            }

            if (event.target.matches('.delete-vehicle-btn')) {
                const id = event.target.dataset.id;
                if (!confirm('Delete this vehicle permanently?')) return;
                try {
                    const response = await fetch(`${baseUrl}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    });
                    if (!response.ok) throw new Error('Unable to delete vehicle');
                    removeCard(id);
                } catch (error) {
                    alert(error.message);
                }
            }
        });

        editForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            if (!activeVehicleId) return;
            const formData = new FormData(editForm);
            if (editImage.files.length === 0) {
                formData.delete('image');
            }
            try {
                const response = await fetch(`${baseUrl}/${activeVehicleId}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });
                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Unable to update vehicle');
                }
                const result = await response.json();
                refreshCard(result.vehicle);
                toggleModal(editModal, false);
            } catch (error) {
                alert(error.message);
            }
        });

        [closeViewModal, closeEditModal, cancelEdit].forEach((button) => {
            button.addEventListener('click', () => {
                toggleModal(viewModal, false);
                toggleModal(editModal, false);
            });
        });
    });
</script>
@endsection
