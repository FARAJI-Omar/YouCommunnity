<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\RSVP;
use App\Models\User;


class Event extends Model
{
    // Define the fillable properties so we can mass assign them
    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'max_participants',
        'category',
        'user_id',
    ];

    use HasFactory;

    // Define the relationship with the RSVP model (each event has many rsvps)
    public function rsvps()
    {
        return $this->hasMany(RSVP::class);
    }


    // Define the relationship with the User model (each event belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Comments model (each event has many comments) 
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
