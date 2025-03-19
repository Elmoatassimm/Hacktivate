<?php

namespace App\Http\Controllers;

use App\Models\EventApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EventApproval::with(['event', 'user'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not typically used in API controllers
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'status' => 'required|in:approved,rejected',
            'remarks' => 'nullable|string',
        ]);

        $request['approved_by'] = Auth::id();

        $eventApproval = EventApproval::create($request->all());
        return response()->json($eventApproval, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EventApproval $eventApproval)
    {
        return $eventApproval->load(['event', 'approvedBy']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventApproval $eventApproval)
    {
        // Not typically used in API controllers
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventApproval $eventApproval)
    {
        $request->validate([
            'event_id' => 'sometimes|required|exists:events,id',
            'approved_by' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|required|in:approved,rejected',
            'remarks' => 'nullable|string',
        ]);

        $eventApproval->update($request->all());
        return response()->json($eventApproval);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventApproval $eventApproval)
    {
        $eventApproval->delete();
        return response()->json(null, 204);
    }
}
