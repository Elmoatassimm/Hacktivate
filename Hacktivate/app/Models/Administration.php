<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;

    protected $fillable = ['university_id', 'name', 'email', 'phone'];

    // Define the relationship with universities
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
