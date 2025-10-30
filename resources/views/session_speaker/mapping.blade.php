<x-layout>
    <x-slot name="title">Assign Speaker to Session</x-slot>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200 max-w-lg mx-auto">
        <form
            id="mappingForm"
            method="POST"
            action="{{ isset($mapping) ? route('event_session_speaker.update', $mapping->id) : route('event_session_speaker.store') }}"
        >
            @csrf
            @if(isset($mapping))
                @method('PUT')
            @endif

            <div class="space-y-6">
                <!-- Event -->
                 <input type="hidden" name="from_resource" value="{{ $from_resource}}">
                <div>
                    <label for="event_id" class="block text-sm font-medium text-gray-700 mb-1">Select Event</label>
                    <select
                        name="event_id"
                        id="event_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        @foreach($events as $event)
                            <option value="{{ $event->id }}"
                                {{ old('event_id', $mapping->event_id ?? $selectedEvent->id ?? '') == $event->id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Session -->
                <div>
                    <label for="session_id" class="block text-sm font-medium text-gray-700 mb-1">Select Session</label>
                    <select
                        name="event_session_id"
                        id="session_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}"
                                {{ old('session_id', $mapping->session_id ?? '') == $session->id ? 'selected' : '' }}>
                                {{ $session->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_session_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Speaker -->
                <div>
                    <label for="speaker_id" class="block text-sm font-medium text-gray-700 mb-1">Select Speaker</label>
                    <select
                        name="speaker_id"
                        id="speaker_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                        @foreach($speakers as $speaker)
                            <option value="{{ $speaker->id }}"
                                {{ old('speaker_id', $mapping->speaker_id ?? '') == $speaker->id ? 'selected' : '' }}>
                                {{ $speaker->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('speaker_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </div>

    <!-- Footer Slot -->
    <x-slot name="footer">
        <div class="flex justify-end gap-3">
            <a href="{{ route('event_session_speaker.index') }}"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium text-gray-800">
                Cancel
            </a>
            <button
                type="submit"
                form="mappingForm"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium"
            >
                {{ isset($mapping) ? 'Update Mapping' : 'Assign Speaker' }}
            </button>
        </div>
    </x-slot>
</x-layout>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const eventSelect = document.getElementById('event_id');
    const sessionSelect = document.getElementById('session_id');
    const speakerSelect = document.getElementById('speaker_id');

    eventSelect.addEventListener('change', function () {
        const eventId = this.value;

        // Clear old options
        sessionSelect.innerHTML = '<option value="">-- Choose Session --</option>';
        speakerSelect.innerHTML = '<option value="">-- Choose Speaker --</option>';

        if (!eventId) return; // if no event selected, stop

        // Fetch sessions and speakers for selected event
        fetch(`/event/${eventId}/related-data`)
            .then(response => response.json())
            .then(data => {
                // Populate sessions
                data.sessions.forEach(session => {
                    const option = document.createElement('option');
                    option.value = session.id;
                    option.textContent = session.title;
                    sessionSelect.appendChild(option);
                });

                // Populate speakers
                data.speakers.forEach(speaker => {
                    const option = document.createElement('option');
                    option.value = speaker.id;
                    option.textContent = speaker.name;
                    speakerSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching event data:', error);
            });
    });
});
</script>

