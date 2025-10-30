
<x-layout>
<!-- Data Table -->
    <div class="mb-4 flex justify-between items-center">
        <!-- Search -->
        <form method="GET" action="{{ route('event_session_speaker.index') }}" class="flex gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search by event, session, or speaker..." 
                class="border border-gray-300 rounded px-3 py-2"
            />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 border-b">
                <tr>
                    @php
                        $sortDir = request('sort_dir', 'asc') === 'asc' ? 'desc' : 'asc';
                    @endphp

                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                        <a href="{{ route('event_session_speaker.index', ['sort_by' => 'id', 'sort_dir' => $sortDir] + request()->all()) }}">
                            #
                            @if(request('sort_by') === 'id')
                                {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>

                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                        <a href="{{ route('event_session_speaker.index', ['sort_by' => 'event_id', 'sort_dir' => $sortDir] + request()->all()) }}">
                            Event
                            @if(request('sort_by') === 'event_id')
                                {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>

                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                        <a href="{{ route('event_session_speaker.index', ['sort_by' => 'session_id', 'sort_dir' => $sortDir] + request()->all()) }}">
                            Session
                            @if(request('sort_by') === 'session_id')
                                {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>

                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                        <a href="{{ route('event_session_speaker.index', ['sort_by' => 'speaker_id', 'sort_dir' => $sortDir] + request()->all()) }}">
                            Speaker
                            @if(request('sort_by') === 'speaker_id')
                                {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>

                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                        <a href="{{ route('event_session_speaker.index', ['sort_by' => 'status', 'sort_dir' => $sortDir] + request()->all()) }}">
                            Status
                            @if(request('sort_by') === 'status')
                                {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                            @endif
                        </a>
                    </th>

                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($roster as $index => $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-4">{{ $roster->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-medium text-gray-700">{{ $item->event->name }}</td>
                        <td class="py-3 px-4 font-medium text-gray-700">{{ $item->session->title }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $item->speaker->name }}</td>
                        <td class="py-3 px-4 text-gray-600">
                            <span class="{{ $item->status ? 'text-green-600' : 'text-red-500' }}">
                                {{ $item->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex gap-3">
                                <a href="{{ route('event_session_speaker.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('event_session_speaker.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $roster->links() }}
    </div>


    <x-slot name="footer">
        <a 
            href="{{ route('event_session_speaker.create') }}" 
            role="button"
            class="py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded text-white"
        >
            Map Roster
        </a>
    </x-slot>
</x-layout>