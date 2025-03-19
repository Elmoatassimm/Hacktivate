<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventApproval extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'approved_by', 'status', 'remarks', 'approved_at'];

    // Define the relationship with events
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Define the relationship with users
    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
