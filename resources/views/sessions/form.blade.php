<form
    id="sessionForm"
    method="POST"
    action="{{ isset($session) ? route('sessions.update', $session->id) : route('sessions.store') }}"
>
    @csrf
    @if(isset($session))
        @method('PUT')
    @endif

    <div class="space-y-6">
        <!-- Event Selection -->
        <div>
            <label for="event_id" class="block text-sm font-medium text-gray-700 mb-1">Event</label>
            <select
                name="event_id"
                id="event_id"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >
                <option value="">Select Event</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}"
                        {{ old('event_id', $session->event_id ?? '') == $event->id ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                @endforeach
            </select>
            @error('event_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Session Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Session Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $session->title ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter session title"
                required
            >
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Start Time -->
        <div>
            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
            <input
                type="time"
                name="start_time"
                id="start_time"
                value="{{ old('start_time', $session->getRawOriginal('start_time') ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >
            @error('start_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- End Time -->
        <div>
            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
            <input
                type="time"
                name="end_time"
                id="end_time"
                value="{{ old('end_time', $session->getRawOriginal('end_time') ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >
            @error('end_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea
                name="description"
                id="description"
                rows="4"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter session description"
            >{{ old('description', $session->description ?? '') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        @if(isset($session))
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select
                name="status"
                id="status"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >
                <option value="1" {{ old('status', $session->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $session->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        @endif

        
    </div>
</form>
