<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSession;
use App\Models\Speaker;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $eventCount = Event::count();
        $sessionCount = EventSession::where('status', 1)->count(); // optional: count only active
        $speakerCount = Speaker::count();

        return view('dashboard.dashboard', compact('eventCount', 'sessionCount', 'speakerCount'));
    }
}
