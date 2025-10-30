<x-layout>
    <x-slot name="title">Session Details</x-slot>

    <!-- Session Information -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Session Information</h2>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">Title</p>
                <p class="text-lg font-medium text-gray-900">{{ $session->title }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Event</p>
                <p class="text-lg font-medium text-gray-900">{{ $session->event->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Start Time</p>
                <p class="text-lg font-medium text-gray-900">{{ $session->start_time ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">End Time</p>
                <p class="text-lg font-medium text-gray-900">{{ $session->end_time ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="{{ $session->status ? 'text-green-600' : 'text-red-600' }} font-semibold">
                    {{ $session->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="col-span-2">
                <p class="text-sm text-gray-500">Description</p>
                <p class="text-gray-800">{{ $session->description ?? '—' }}</p>
            </div>
        </div>
    </div>

    <!-- Speakers Mapped to This Session -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Speakers</h2>
            <a href="{{ route('event_session_speaker.create', ['session_id' => $session->id]) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md">
                + Assign Speaker
            </a>
        </div>

        @if ($session->speakers->isNotEmpty())
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Speaker Name</th>
                        <th class="px-4 py-2 border">Expertise</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($session->speakers as $speaker)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $speaker->name }}</td>
                            <td class="px-4 py-2 border">{{ $speaker->expertise ?? '-' }}</td>
                            <td class="px-4 py-2 border">
                                @if ($speaker->status)
                                    <span class="text-green-600 font-semibold">Active</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <a href="{{ route('speakers.show', $speaker->id) }}"
                                   class="text-blue-600 hover:underline">View</a> |
                                <a href="{{ route('speakers.edit', $speaker->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600 text-sm">No speakers assigned to this session.</p>
        @endif
    </div>

    <!-- Footer Buttons -->
    <x-slot name="footer">
        <div class="flex justify-end gap-3">
            <a href="{{ route('sessions.index') }}"
               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium text-gray-800">
                Back to Sessions
            </a>
            <a href="{{ route('sessions.edit', $session->id) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium">
                Edit Session
            </a>
        </div>
    </x-slot>
</x-layout>
