<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;

class EventController extends Controller
{

    public function index()
    {
        // Fetch events with pagination (6 per page)
        $events = Event::paginate(6);
        return view('events.index', compact('events'));
    }

    public function homePageEvents(){
        $events = Event::all();
        return view('dashboard', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'max_participants' => 'required|integer',
        ]);

        // Create the event
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'max_participants' => $request->max_participants,
            'user_id' => auth()->id(), // Associate event with the currently logged-in user
        ]);

        return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    /**
     * Custom method to delete an event from My Events.
     */
    public function destroyMy(Event $event)
    {
        // Ensure the logged-in user is the owner
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }
        $event->delete();
        // Redirect back to the My Events index view after deletion
        return redirect()->route('events.my')->with('status', 'Event deleted successfully.');
    }

    // New method to display events created by the logged-in user
    public function myEvents()
    {
        $events = Event::where('user_id', auth()->id())->get();
        return view('events.my.index', compact('events'));
    }
}
