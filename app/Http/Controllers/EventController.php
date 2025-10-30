<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Event; // Import model
use App\Http\Requests\StoreEventRequest; // Form Request for creation
use App\Http\Requests\UpdateEventRequest; // Form Request for updation

class EventController extends Controller
{
    /**
     * Listing the events.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        //  Search filter
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('date', 'like', "%{$search}%");
        }

        //  Sorting
        $sortBy = $request->input('sort_by', 'id');
        $sortDir = $request->input('sort_dir', 'asc');
        $allowedSorts = ['id', 'name', 'date'];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        }

        //  Pagination (10 per page)
        $events = $query->paginate(2)->appends($request->query());

        return view('events.events', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(StoreEventRequest $request)
    {
    
        $validated = $request->validated();

        Event::create($validated);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $event = Event::with(['sessions', 'speakers'])->findOrFail($id);

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Soft delete.
     */
    public function destroy(Event $event)
    {
        $event->update(['status' => 0]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deactivated successfully!');

        
    }

}

