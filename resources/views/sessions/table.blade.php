<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100 border-b">
            @php
                $sortDir = request('sort_dir', 'asc') === 'asc' ? 'desc' : 'asc';
            @endphp
            <tr>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'id', 'sort_dir' => $sortDir] + request()->all()) }}" data-ajax>#</a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'title', 'sort_dir' => $sortDir] + request()->all()) }}" data-ajax>
                        Session Name
                        @if(request('sort_by') === 'title')
                            {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'event_id', 'sort_dir' => $sortDir] + request()->all()) }}" data-ajax>Event</a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'start_time', 'sort_dir' => $sortDir] + request()->all()) }}" data-ajax>Start</a>
                </th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 uppercase">
                    <a href="{{ route('sessions.index', ['sort_by' => 'end_time', 'sort_dir' => $sortDir] + request()->all()) }}" data-ajax>End</a>
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
    @if ($sessions->hasPages())
        <div class="flex justify-center">
            {{ $sessions->appends(request()->except('page'))->links('pagination::tailwind') }}
        </div>
    @endif
</div>
