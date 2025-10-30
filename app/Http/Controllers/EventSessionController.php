<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSession;
use App\Models\Session;
use App\Models\Event;
use App\Http\Requests\StoreEventSessionRequest; // Form Request for creation
use App\Http\Requests\UpdateEventSessionRequest;

class EventSessionController extends Controller
{
    /**
     * Display a listing of sessions for a specific event.
     */
    public function index(Request $request)
    {
        $query = EventSession::with('event');

        // Search
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('event', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'id');
        $sortDir = $request->input('sort_dir', 'asc');
        $allowedSorts = ['id', 'title', 'event_id', 'start_time', 'end_time'];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        }

        // Pagination
        $sessions = $query->paginate(2)->appends($request->query());

        return view('sessions.sessions', compact('sessions'));
    }


    /**
     * Show the form for creating a new session for an event.
     */
    public function create(Request $request)
    {
        $selectedEventId = $request->query('event_id'); // get from URL 
        

        // Fetch all events (for dropdown selection)
        if ($selectedEventId) {
            // Fetch only the selected event
            $events = Event::active()
                ->where('id', $selectedEventId)
                ->get();
        } else {
            // Fetch all events (for dropdown selection)
            $events = Event::active()->get();
            $events->prepend((object)[
                'id' => '',
                'name' => 'Select an Event'
            ]);
        }

        return view('sessions.create', compact('events', 'selectedEventId'));
    }




    /**
     * Store a newly created session in storage.
     */
    public function store(StoreEventSessionRequest $request)
    {

        $validated = $request->validated();        

        EventSession::create($validated);

        return redirect()
            ->route('sessions.index')
            ->with('success', 'Session created successfully!');
    }

    

    /**
     * Display the specified session.
     */
    public function show($id)
    {
       
        $session = EventSession::with(['event', 'speakers'])->findOrFail($id);        

        return view('sessions.show', compact('session'));
    }
    /**
     * Show the form for editing the specified session.
     */
    public function edit( $sessionId)
    {
        $session = EventSession::with('event')->findOrFail($sessionId);
        $events = Event::active()->get(); // if you need dropdown of events

        return view('sessions.edit', compact('session', 'events'));
    }

    /**
     * Update the specified session in storage.
     */
    public function update(UpdateEventSessionRequest $request, $id)
    {
        $session = EventSession::findOrFail($id);
        $session->update($request->validated());

        return redirect()
            ->route('sessions.index')
            ->with('success', 'Session updated successfully!');
    }

    

    /**
     * Soft delete.
     */
    public function destroy(EventSession $session)
    {
        $session->update(['status' => 0]);

        return redirect()
            ->route('sessions.index')
            ->with('success', 'Session deactivated successfully!');

        
    }

}
