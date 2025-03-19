<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['club_id', 'title', 'description', 'event_date', 'location', 'status'];

    // Define the relationship with clubs
    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    // Define the relationship with event approvals
    public function approvals()
    {
        return $this->hasMany(EventApproval::class);
    }
}
