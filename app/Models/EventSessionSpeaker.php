<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSessionSpeaker extends Model
{
    use HasFactory;
    protected $table = 'event_session_speaker'; // <-- your actual table name
    protected $fillable = [
        'event_id',
        'event_session_id',
        'speaker_id',
        'status'
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function session()
    {
        //return $this->belongsTo(EventSession::class);
        return $this->belongsTo(EventSession::class, 'event_session_id');
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }
    
}
