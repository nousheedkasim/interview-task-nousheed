<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventSession;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventSessionRequest;
use Exception;

class EventSessionController extends Controller
{
    public function index()
    {
        return response()->json(EventSession::all());
    }

    public function store(StoreEventSessionRequest $request)
    {
        try {
            $validated = $request->validated();

            $session = EventSession::create($validated);

            return response()->json([
                'message' => 'Session created successfully!',
                'data' => $session
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to create session.',
                'details' => $e->getMessage()
            ], 500);
        }
    }


}
