<?php

namespace App\Http\Controllers;

use App\Models\Club; // Import the Club model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    // Method to create a new club
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'university_id' => 'required|exists:universities,id',
        ]);

        $request['created_by'] = Auth::id();
        $club = Club::create($request->all());
        return response()->json($club, 201);
    }

    // Method to retrieve all clubs
    public function index()
    {
        $clubs = Club::with(['events', 'university'])->get();
        return response()->json($clubs);
    }

    // Method to retrieve a specific club
    public function show($id)
    {
        $club = Club::findOrFail($id);
        return response()->json($club);
    }

    // Method to update a specific club
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'created_by' => 'sometimes|required|exists:users,id',
            'university_id' => 'sometimes|required|exists:universities,id',
        ]);

        $club = Club::findOrFail($id);
        $club->update($request->all());
        return response()->json($club);
    }

    // Method to delete a specific club
    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $club->delete();
        return response()->json(null, 204);
    }
}
