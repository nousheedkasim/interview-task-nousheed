<?php
// app/Models/Speaker.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    // Allow mass assignment for these attributes
    protected $fillable = [
        'event_id',
        'name',
        'expertise',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // relationship: each speaker belongs to an event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // A Speaker belongs to many Sessions
    public function sessions()
    {
        return $this->belongsToMany(EventSession::class, 'event_session_speaker')
                    ->withTimestamps();
    }

    
}
