@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Contact Messages</h1>
        <p class="mt-1 text-sm text-gray-600">Messages submitted via the public contact form.</p>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">#</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Subject</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Message</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Received</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($messages as $msg)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $msg->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $msg->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700"><a href="mailto:{{ $msg->email }}" class="text-blue-500 hover:text-blue-700">{{ $msg->email }}</a></td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $msg->subject }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ Str::limit($msg->message, 120) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">No messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $messages->links() }}</div>
    </div>
</div>
@endsection
