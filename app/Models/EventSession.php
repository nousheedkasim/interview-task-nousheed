<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class EventSession extends Model
{
    use HasFactory;

    protected $table = 'event_sessions'; // or 'event_sessions' if that's your actual table name

    protected $fillable = [
        'event_id',
        'title',
        'start_time',
        'end_time',
        'description',
        'status',
    ];

    // relationship: each session belongs to an event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // A Session has many Speakers (many-to-many)
    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_session_speaker')
                    ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // formating time using Accessor while fetch data
    public function getStartTimeAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('g:i A');
    }

    // formating time using Accessor while fetch data
    public function getEndTimeAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('g:i A');
    }

    // formating time using Mutator while storing data
    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value)->format('H:i:s');
    }

    // formating time using Mutator while storing data
    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value)->format('H:i:s');
    }

    


}
