
<x-layout>
<!-- Data Table -->
    <!-- Search + Table -->
<div class="mb-4 flex justify-between items-center">
    <!-- Search -->
    <form method="GET" action="{{ route('sessions.index') }}" class="flex gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search sessions..." 
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
                    <a href="{{ route('sessions.index', ['sort_by' => 'id', 'sort_dir' => $sortDir] + request()->all()) }}">
                        #
                        @if(request('sort_by') === 'id')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'title', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Session Name
                        @if(request('sort_by') === 'title')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'event_id', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Event
                        @if(request('sort_by') === 'event_id')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'start_time', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Session Start
                        @if(request('sort_by') === 'start_time')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'end_time', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Session End
                        @if(request('sort_by') === 'end_time')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sessions as $index => $session)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">{{ $sessions->firstItem() + $index }}</td>
                    <td class="py-3 px-4 font-medium text-gray-700">{{ $session->title }}</td>
                    <td class="py-3 px-4 font-medium text-gray-700">{{ $session->event->name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $session->start_time }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $session->end_time }}</td>
                    <td class="py-3 px-4">
                        <div class="flex gap-3">
                            <a href="{{ route('sessions.edit', $session->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Delete this session?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                            <a href="{{ route('sessions.show', $session->id) }}" class="text-green-500 hover:underline">View</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No sessions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $sessions->links() }}
</div>


    <x-slot name="footer">
        <a 
            href="{{ route('sessions.create') }}" 
            role="button"
            class="py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded text-white"
        >
            Add New Session
        </a>
    </x-slot>
</x-layout>