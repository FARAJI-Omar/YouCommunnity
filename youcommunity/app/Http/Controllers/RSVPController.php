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
    public function store(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

    // Check if the user has already RSVPed
    $existingRSVP = RSVP::where('user_id', auth()->id())->where('event_id', $eventId)->first();
    if ($existingRSVP) {
        return back()->with('error', 'You have already RSVPed to this event.');
    }

    // Check if there are available spots
    if ($event->rsvps()->count() >= $event->max_participants) {
        return back()->with('error', 'This event has reached its maximum number of participants.');
    }

    // Create RSVP
    RSVP::create([
        'user_id' => auth()->id(),
        'event_id' => $eventId,
    ]);

    return back()->with('success', 'You have successfully RSVPed to the event.');
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
    public function destroy($eventId)
    {
        // Cancel the RSVP
    $rsvp = RSVP::where('user_id', auth()->id())->where('event_id', $eventId)->first();
    if ($rsvp) {
        $rsvp->delete();
        return back()->with('success', 'You have successfully canceled your RSVP.');
    }

    return back()->with('error', 'You have not RSVPed to this event.');
    }
}
