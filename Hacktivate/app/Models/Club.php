<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'logo', 'created_by', 'university_id'];

    // Define the relationship with users
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Define the relationship with events
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // Define the relationship with universities
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
