<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment; // Add Comment import

class Event extends Model
{
    use HasFactory;

    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }

    // Define the fillable properties so we can mass assign them
    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'max_participants',
        'user_id',
    ];

    // Define the relationship with the User model (each event belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Added relationship for comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
