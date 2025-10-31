<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSession;
use App\Models\Speaker;

class DashboardController extends Controller
{
    /**
     * Display dashboard with key statistics.
     */
    public function dashboard()
    {
        // fetch Count total number of active records

        $eventCount = Event::active()->count();        
        $sessionCount = EventSession::active()->count();
        $speakerCount = Speaker::active()->count();

        // Pass data to the dashboard view
        return view('dashboard.dashboard', compact('eventCount', 'sessionCount', 'speakerCount'));
    }
}
