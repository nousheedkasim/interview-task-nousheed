<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSessionSpeaker;
use App\Models\Event;
use App\Models\EventSession;
use App\Models\Speaker;
use App\Http\Requests\StoreEventSessionSpeakerRequest;
use App\Http\Requests\UpdateEventSessionSpeakerRequest;

class EventSessionSpeakerController extends Controller
{
    public function index(Request $request)
    {
        $query = EventSessionSpeaker::with(['event', 'session', 'speaker']);
        //  Search logic
        if ($search = $request->get('search')) {
            $query->whereHas('event', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('session', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            })->orWhereHas('speaker', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        //  Sorting logic
        $sortBy = $request->get('sort_by', 'id');
        $sortDir = $request->get('sort_dir', 'asc');

        // Default to local column sorting, fallback for relations
        if (in_array($sortBy, ['id', 'status'])) {
            $query->orderBy($sortBy, $sortDir);
        } elseif ($sortBy === 'event_id') {
            $query->join('events', 'events.id', '=', 'event_session_speaker.event_id')
                ->orderBy('events.name', $sortDir)
                ->select('event_session_speaker.*');
        } elseif ($sortBy === 'session_id') {
            $query->join('event_sessions', 'event_sessions.id', '=', 'event_session_speaker.session_id')
                ->orderBy('event_sessions.title', $sortDir)
                ->select('event_session_speaker.*');
        } elseif ($sortBy === 'speaker_id') {
            $query->join('speakers', 'speakers.id', '=', 'event_session_speaker.speaker_id')
                ->orderBy('speakers.name', $sortDir)
                ->select('event_session_speaker.*');
        }

        $roster = $query->paginate(2)->withQueryString();

        return view('session_speaker.roster', compact('roster'));
    }

    public function create(Request $request)
    {
        $session_id = $request->query('session_id');
        $speaker_id = $request->query('speaker_id');
        $eventId = $request->query('event_id');

        $sessions = collect();
        $speakers = collect();
        $events = collect();
        $selectedEvent = null;

        if ($session_id) {
            // Case 1: session_id present → find its event
            $session = EventSession::with('event')->findOrFail($session_id);
            $selectedEvent = $session->event;

            // Related data for dropdowns
            $sessions = $selectedEvent->sessions;
            $speakers = $selectedEvent->speakers;

            // Wrap single event for dropdown consistency
            $events = collect([$selectedEvent]);

            $speakers = $speakers->prepend((object)[
                'id' => '',
                'name' => '-- Choose Speaker --'
            ]);

            $from_resource = "session";
            

        } elseif ($speaker_id) {
            // Case 2: speaker_id present → find event of that speaker
            $speaker = Speaker::with('event')->findOrFail($speaker_id);
            $selectedEvent = $speaker->event;
            $sessions = $selectedEvent->sessions;
            $speakers = $selectedEvent->speakers;
            $events = collect([$selectedEvent]);

            $sessions = $sessions->prepend((object)[
                'id' => '',
                'title' => '-- Choose Session --'
            ]);

            $from_resource = "speaker";

        } elseif ($eventId) {
            // Case 3: event_id directly provided
            $selectedEvent = Event::with(['sessions', 'speakers'])->findOrFail($eventId);
            $sessions = $selectedEvent->sessions;
            $speakers = $selectedEvent->speakers;
            $events = collect([$selectedEvent]);

            $sessions = $sessions->prepend((object)[
                'id' => '',
                'name' => '-- Choose Session --'
            ]);

            $speakers = $speakers->prepend((object)[
                'id' => '',
                'name' => '-- Choose Speaker --'
            ]);
        } else {
            // Case 4: no preselection → show all
            $events = Event::active()->with(['sessions', 'speakers'])->get();           

            // Also fetch all sessions and speakers (for general use or filters)
            $sessions = EventSession::with('event')->get();
            $speakers = Speaker::with('event')->get();

            $events = $events->prepend((object)[
                'id' => 'null',
                'name' => '-- Choose Event --'
            ]);

            $sessions = $sessions->prepend((object)[
                'id' => '',
                'title' => '-- Choose Session --'
            ]);

            $speakers = $speakers->prepend((object)[
                'id' => '',
                'name' => '-- Choose Speaker --'
            ]);

            $from_resource = "roster";
        }

        return view('session_speaker.mapping', compact('events', 'sessions', 'speakers', 'selectedEvent','from_resource'));
    }


    public function store(StoreEventSessionSpeakerRequest $request)
    {
        $validated = $request->validated();
        $from_resource = $request->input('from_resource');
        EventSessionSpeaker::create($validated);

        if($from_resource == 'session'){
            $event_session_id = $request->input('event_session_id');

            // Redirect with query parameter
            return redirect()->route('sessions.show', ['session' => $event_session_id])
            ->with('success', 'Record created successfully.');
        }
        else if ($from_resource == 'speaker') {
            $speaker_id = $request->input('speaker_id');

            // Redirect with query parameter
            return redirect()->route('speakers.show', ['speaker' => $speaker_id])
                ->with('success', 'Record updated successfully.');
        }else{
            return redirect()->route('event_session_speaker.index')
             ->with('success', 'Record created successfully.');
        }
    }

    public function edit($id)
    {
        $mapping = EventSessionSpeaker::with(['event', 'session', 'speaker'])->findOrFail($id);

        $selectedEvent = $mapping->event;
        $selectedSession = $mapping->session;
        $selectedSpeaker = $mapping->speaker;

        // Prepare lists
        $events = Event::active()->with(['sessions', 'speakers'])->get();
        $sessions = collect();
        $speakers = collect();

        if ($selectedEvent) {
            // Fetch related sessions/speakers for selected event
            $sessions = $selectedEvent->sessions ?? collect();
            $speakers = $selectedEvent->speakers ?? collect();
        } else {
            // Fallback in case event is missing (shouldn't happen)
            $sessions = EventSession::all();
            $speakers = Speaker::all();
        }

        // Prepend "choose" options
        $events = $events->prepend((object)[
            'id' => 'null',
            'name' => '-- Choose Event --'
        ]);

        $sessions = $sessions->prepend((object)[
            'id' => '',
            'title' => '-- Choose Session --'
        ]);

        $speakers = $speakers->prepend((object)[
            'id' => '',
            'name' => '-- Choose Speaker --'
        ]);

        $from_resource = 'roster'; // Default context (you can adjust if needed)

        return view('session_speaker.edit', compact(
            'mapping',
            'events',
            'sessions',
            'speakers',
            'selectedEvent',
            'from_resource'
        ));
    }


    public function update(UpdateEventSessionSpeakerRequest $request, $id)
    {

        
        $validated = $request->validated();
        $from_resource = $request->input('from_resource');

        $mapping = EventSessionSpeaker::findOrFail($id);
        $mapping->update($validated);

        if ($from_resource == 'session') {
            $event_session_id = $request->input('event_session_id');

            // Redirect with query parameter
            return redirect()->route('sessions.show', ['session' => $event_session_id])
                ->with('success', 'Record updated successfully.');
        } 
       else if ($from_resource == 'speaker') {
            $speaker_id = $request->input('speaker_id');

            // Redirect with query parameter
            return redirect()->route('speakers.show', ['speaker' => $speaker_id])
                ->with('success', 'Record updated successfully.');
        }
        else {
            return redirect()->route('event_session_speaker.index')
                ->with('success', 'Record updated successfully.');
        }
    }

    /**
     * Soft delete.
     */
    public function destroy(EventSessionSpeaker $event_session_speaker)
    {

        $event_session_speaker->update(['status' => 0]);

        return redirect()
            ->route('event_session_speaker.index')
            ->with('success', 'Mapping deactivated successfully!');

        
    }


    public function getRelatedData($eventId)
    {
        // Treat the string "null" as no event selected
        if ($eventId === 'null' || empty($eventId)) {
            $eventId = null;
        }

        // Fetch all sessions — filter only if eventId is provided
        $sessionsQuery = \App\Models\EventSession::select('id', 'title');
        if (!is_null($eventId)) {
            $sessionsQuery->where('event_id', $eventId);
        }
        $sessions = $sessionsQuery->get();

        // Fetch all speakers — filter only if eventId is provided
        $speakersQuery = \App\Models\Speaker::select('id', 'name');
        if (!is_null($eventId)) {
            $speakersQuery->where('event_id', $eventId);
        }
        $speakers = $speakersQuery->get();

        return response()->json([
            'sessions' => $sessions,
            'speakers' => $speakers,
        ]);
    }

}
