<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventSession;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventSessionRequest;
use Exception;

class EventSessionController extends Controller
{

    /**
     * Return a list of all event sessions.
     */
    public function index()
    {
        // Retrieve all event sessions and return as JSON
        return response()->json(EventSession::all());
    }

    /**
     * Store a newly created event session in storage.
     */
    public function store(StoreEventSessionRequest $request)
    {
        try {
            // Validate incoming request data through form request
            $validated = $request->validated();

            // Create a new event session using validated data
            $session = EventSession::create($validated);

            // Return success response with created session data
            return response()->json([
                'message' => 'Session created successfully!',
                'data' => $session
            ], 201);
        } catch (Exception $e) {

            // Return error response in case of failure
            return response()->json([
                'error' => 'Failed to create session.',
                'details' => $e->getMessage()
            ], 500);
        }
    }


}
