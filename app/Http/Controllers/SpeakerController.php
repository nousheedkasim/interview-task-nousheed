<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use App\Models\Event;
use App\Http\Requests\StoreSpeakerRequest;
use App\Http\Requests\UpdateSpeakerRequest;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index(Request $request)
    {
        $query = Speaker::with('event');

        // Search
        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('expertise', 'like', "%{$search}%");
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortDir = $request->get('sort_dir', 'asc');

        $speakers = $query->orderBy($sortBy, $sortDir)->paginate(2)->withQueryString();

        return view('speakers.speakers', compact('speakers'));
    }

    /**
     * Show the form for creating a new session for an event.
     */
    public function create(Request $request)
    {
        $selectedEventId = $request->query('event_id'); // get from URL 

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


        return view('speakers.create', compact('events', 'selectedEventId'));
    }






    public function store(StoreSpeakerRequest $request)
    {
        $validated = $request->validated();        

        Speaker::create($validated);

        return redirect()
            ->route('speakers.index')
            ->with('success', 'Speaker created successfully!');
    }


    /**
     * Display the specified speaker and its details.
     */
    public function show($id)
    {
       
        $speakers = Speaker::with(['event', 'sessions'])->findOrFail($id);        

        return view('speakers.show', compact('speakers'));
    }


    /**
     * Show the form for editing the specified speaker.
     */
    public function edit( $speakerId)
    {
        $speaker = Speaker::with('event')->findOrFail($speakerId);
        $events = Event::active()->get(); // if you need dropdown of events

        return view('speakers.edit', compact('speaker', 'events'));
    }


    


    public function update(UpdateSpeakerRequest $request, $speaker)
    {
        $speaker = Speaker::findOrFail($speaker);
        $speaker->update($request->validated());

        return redirect()
            ->route('speakers.index')
            ->with('success', 'Speaker updated successfully!');

    }

     /**
     * Soft delete.
     */
    public function destroy(Speaker $speaker)
    {
        $speaker->update(['status' => 0]);

        return redirect()
            ->route('speakers.index')
            ->with('success', 'Speaker deactivated successfully!');

        
    }
}
