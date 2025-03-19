<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_email'];

    // Define the relationship with clubs
    public function clubs()
    {
        return $this->hasMany(Club::class);
    }

    // Define the relationship with administrations
    public function administrations()
    {
        return $this->hasMany(Administration::class);
    }
}
