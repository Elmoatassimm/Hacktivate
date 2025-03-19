<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all events with their associated club and approvals
        $events = Event::with(['club', 'approvals'])->get();
        return response()->json($events);
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
    public function store(Request $request)
    {
        $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event = Event::create($request->all());
        return response()->json($event->load('club'), 201); // Load club relationship
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Load the club and approvals for the specific event
        return response()->json($event->load(['club', 'approvals']));
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
        $request->validate([
            'club_id' => 'sometimes|required|exists:clubs,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'sometimes|required|date',
            'location' => 'sometimes|required|string|max:255',
        ]);

        $event->update($request->all());
        return response()->json($event->load('club')); // Load club relationship
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(null, 204);
    }
}
