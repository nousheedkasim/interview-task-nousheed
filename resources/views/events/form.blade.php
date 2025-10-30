<form
    id="eventForm"
    method="POST"
    action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}"
>
    @csrf
    @if(isset($event))
        @method('PUT')
    @endif

    <div class="space-y-6">
        <!-- Event Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Event Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $event->name ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter event name"
                required
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Date -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
            <input
                type="date"
                name="date"
                id="date"
                value="{{ old('date', isset($event->date) ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >
            @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Location -->
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input
                type="text"
                name="location"
                id="location"
                value="{{ old('location', $event->location ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter event location"
            >
            @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Event Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea
                name="description"
                id="description"
                rows="4"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter event description"
            >{{ old('description', $event->description ?? '') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</form>
