<form
    id="speakerForm"
    method="POST"
    action="{{ isset($speaker) ? route('speakers.update', $speaker->id) : route('speakers.store') }}"
>
    @csrf
    @if(isset($speaker))
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
                @foreach($events as $event)
                    <option value="{{ $event->id }}"
                        {{ old('event_id', $speaker->event_id ?? '') == $event->id ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                @endforeach
            </select>
            @error('event_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- speaker Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Speaker Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $speaker->name ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter Speaker name"
                required
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        

        <!-- Expertise -->
        <div>
            <label for="expertise" class="block text-sm font-medium text-gray-700 mb-1">Expertise</label>
            <textarea
                name="expertise"
                id="expertise"
                rows="4"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter speaker expertise"
            >{{ old('expertise', $speaker->expertise ?? '') }}</textarea>
            @error('expertise')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status (Only show when editing) -->
        @if(isset($speaker))
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select
                    name="status"
                    id="status"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="1" {{ old('status', $speaker->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $speaker->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        @endif
    </div>
</form>
