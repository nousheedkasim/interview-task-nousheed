<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    /**
     * Display a listing of all speaker.
     */
    public function index()
    {
        // Fetch all speaker from the database and return as JSON response
        return response()->json(Speaker::all());
    }


}
