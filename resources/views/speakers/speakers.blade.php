
<x-layout>
<!-- Data Table -->
<div class="mb-4 flex justify-between items-center">
    <!-- Search -->
    <form method="GET" action="{{ route('speakers.index') }}" class="flex gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search speakers..." 
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
                    <a href="{{ route('speakers.index', ['sort_by' => 'id', 'sort_dir' => $sortDir] + request()->all()) }}">
                        #
                        @if(request('sort_by') === 'id')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('speakers.index', ['sort_by' => 'name', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Speaker Name
                        @if(request('sort_by') === 'name')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('speakers.index', ['sort_by' => 'event_id', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Event
                        @if(request('sort_by') === 'event_id')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('speakers.index', ['sort_by' => 'expertise', 'sort_dir' => $sortDir] + request()->all()) }}">
                        Expertise
                        @if(request('sort_by') === 'expertise')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($speakers as $index => $speaker)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">{{ $speakers->firstItem() + $index }}</td>
                    <td class="py-3 px-4 font-medium text-gray-700">{{ $speaker->name }}</td>
                    <td class="py-3 px-4 font-medium text-gray-700">{{ $speaker->event->name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $speaker->expertise }}</td>
                    <td class="py-3 px-4">
                        <div class="flex gap-3">
                            <a href="{{ route('speakers.edit', $speaker->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('speakers.destroy', $speaker->id) }}" method="POST" onsubmit="return confirm('Delete this speaker?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                            <a href="{{ route('speakers.show', $speaker->id) }}" class="text-green-500 hover:underline">View</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No speakers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $speakers->links() }}
</div>


    <x-slot name="footer">
        <a 
            href="{{ route('speakers.create') }}" 
            role="button"
            class="py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded text-white"
        >
            Add New Speaker
        </a>
    </x-slot>
</x-layout>