
<x-layout>
<!-- Data Table -->
    
        <!-- Search + Table -->
<div class="mb-4 flex justify-between items-center">
    <!-- Search -->
    <form method="GET" action="{{ route('events.index') }}" class="flex gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search events..." 
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
                    <a href="{{ route('events.index', ['sort_by' => 'id', 'sort_dir' => $sortDir] + request()->all()) }}">
                        #
                        @if(request('sort_by') === 'id')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('events.index', ['sort_by' => 'name', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Event Name
                        @if(request('sort_by') === 'name')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('events.index', ['sort_by' => 'date', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Date
                        @if(request('sort_by') === 'date')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $index => $event)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">{{ $events->firstItem() + $index }}</td>
                    <td class="py-3 px-4 font-medium text-gray-700">{{ $event->name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $event->date }}</td>
                    <td class="py-3 px-4">
                        <div class="flex gap-3">
                            <a href="{{ route('events.edit', $event->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                            <a href="{{ route('events.show', $event->id) }}" class="text-green-500 hover:underline">View</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">No events found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $events->links() }}
</div>

    

    <x-slot name="footer">
        <a 
            href="{{ route('events.create') }}" 
            role="button"
            class="py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded text-white"
        >
            Add New Event
        </a>
    </x-slot>
</x-layout>