<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

class CommentController extends Controller
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

        // Validate comment content
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        // Create the comment
        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'event_id' => $eventId,
        ]);
    
        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // Check if the logged-in user is the owner of the comment
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        }
    
        return back()->with('error', 'You are not authorized to delete this comment.');
    }
}
