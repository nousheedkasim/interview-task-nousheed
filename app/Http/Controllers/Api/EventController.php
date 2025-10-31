<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of all events.
     */

    public function index()
    {
        // Fetch all events from the database and return as JSON response
        return response()->json(Event::all());
    }


}
