<?php

namespace App\Http\Controllers;

use App\Models\RSVP;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class RSVPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        // Check if user already booked
        if ($event->rsvps()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You have already booked a reservation.');
        }
        $event->rsvps()->create(['user_id' => auth()->id()]);
        return back()->with('success', 'Reservation booked successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(RSVP $rSVP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RSVP $rSVP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RSVP $rSVP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $rsvp = $event->rsvps()->where('user_id', auth()->id())->first();
        if ($rsvp) {
            $rsvp->delete();
            return back()->with('success', 'Reservation cancelled successfully!');
        }
        return back()->with('error', 'No reservation found.');
    }
}
