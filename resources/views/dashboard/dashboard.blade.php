<x-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Tile 1: Events -->
        <a href="{{ route('events.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 block">
            <h2 class="text-lg font-semibold mb-2">Total Events</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $eventCount }}</p>
        </a>

        <!-- Tile 2: Sessions -->
        <a href="{{ route('sessions.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 block">
            <h2 class="text-lg font-semibold mb-2">Active Sessions</h2>
            <p class="text-3xl font-bold text-green-600">{{ $sessionCount }}</p>
        </a>

        <!-- Tile 3: Speakers -->
        <a href="{{ route('speakers.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 block">
            <h2 class="text-lg font-semibold mb-2">Total Speakers</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $speakerCount }}</p>
        </a>
    </div>
</x-layout>
