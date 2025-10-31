<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    // Allow mass assignment for these attributes
    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
        'status', 
    ];

    /**
     * Scope a query to only include active events.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Get all sessions associated with this event.
     */
    public function sessions()
    {
        return $this->hasMany(EventSession::class);
    }

    /**
     * Get all speakers associated with this event.
     */
    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }
}
