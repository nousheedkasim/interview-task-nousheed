<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'date',
        'location',
        'status', 
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function sessions()
    {
        return $this->hasMany(EventSession::class);
    }

    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }
}
