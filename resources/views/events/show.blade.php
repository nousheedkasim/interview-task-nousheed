<x-layout>
    <x-slot name="title">Event Details</x-slot>

    <!-- Event Master Details -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Event Information</h2>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">Event Name</p>
                <p class="text-lg font-medium text-gray-900">{{ $event->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Location</p>
                <p class="text-lg font-medium text-gray-900">{{ $event->location ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date</p>
                <p class="text-lg font-medium text-gray-900">{{ $event->date ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="{{ $event->status ? 'text-green-600' : 'text-red-600' }} font-semibold">
                    {{ $event->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="col-span-2">
                <p class="text-sm text-gray-500">Description</p>
                <p class="text-gray-800">{{ $event->description ?? '—' }}</p>
            </div>
            
        </div>
    </div>

    <!-- Sessions Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Sessions</h2>
            <a href="{{ route('sessions.create', ['event_id' => $event->id]) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md">
                + Add Session
            </a>
        </div>

        @if ($event->sessions->isNotEmpty())
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Start Time</th>
                        <th class="px-4 py-2 border">End Time</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event->sessions as $session)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $session->title }}</td>
                            <td class="px-4 py-2 border">{{ $session->start_time }}</td>
                            <td class="px-4 py-2 border">{{ $session->end_time }}</td>
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
            <p class="text-gray-600 text-sm">No sessions found for this event.</p>
        @endif
    </div>

    <!-- Speakers Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Speakers</h2>
            <a href="{{ route('speakers.create', ['event_id' => $event->id]) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md">
                + Add Speaker
            </a>
        </div>

        @if ($event->speakers->isNotEmpty())
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Expertise</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event->speakers as $speaker)
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
            <p class="text-gray-600 text-sm">No speakers found for this event.</p>
        @endif
    </div>

    <!-- Footer Buttons -->
    <x-slot name="footer">
        <div class="flex justify-end gap-3">
            <a href="{{ route('events.index') }}"
               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium text-gray-800">
                Back to Events
            </a>
            <a href="{{ route('events.edit', $event->id) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium">
                Edit Event
            </a>
        </div>
    </x-slot>
</x-layout>
