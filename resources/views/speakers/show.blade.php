<x-layout>
    <x-slot name="title">Speaker Details</x-slot>

    <!-- Speaker Information -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Speaker Information</h2>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">Title</p>
                <p class="text-lg font-medium text-gray-900">{{ $speakers->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Event</p>
                <p class="text-lg font-medium text-gray-900">{{ $speakers->event->name ?? '-' }}</p>
            </div>            
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="{{ $speakers->status ? 'text-green-600' : 'text-red-600' }} font-semibold">
                    {{ $speakers->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="col-span-2">
                <p class="text-sm text-gray-500">Expertise</p>
                <p class="text-gray-800">{{ $speakers->expertise ?? '—' }}</p>
            </div>
        </div>
    </div>

    <!-- Speakers Mapped to This Session -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Sessions Assigned to This Speaker</h2>
            <a href="{{ route('event_session_speaker.create', ['speaker_id' => $speakers->id]) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md">
                + Assign Session
            </a>
        </div>

        @if ($speakers->sessions->isNotEmpty())
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Session Name</th>
                        <th class="px-4 py-2 border">Start</th>
                        <th class="px-4 py-2 border">End</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($speakers->sessions as $session)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $session->title }}</td>
                            <td class="px-4 py-2 border">{{ $session->start_time ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $session->end_time ?? '-' }}</td>
                            <td class="px-4 py-2 border">
                                @if ($session->status)
                                    <span class="text-green-600 font-semibold">Active</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <a href="{{ route('sessions.show', $session->id) }}"
                                   class="text-blue-600 hover:underline">View</a> |
                                <a href="{{ route('sessions.edit', $session->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600 text-sm">No sessions assigned to this speaker.</p>
        @endif
    </div>

    <!-- Footer Buttons -->
    <x-slot name="footer">
        <div class="flex justify-end gap-3">
            <a href="{{ route('sessions.index') }}"
               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium text-gray-800">
                Back to Speakers
            </a>
            <a href="{{ route('sessions.edit', $speakers->id) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium">
                Edit Speaker
            </a>
        </div>
    </x-slot>
</x-layout>
