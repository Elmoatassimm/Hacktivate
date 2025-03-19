<?php

namespace App\Http\Controllers;

use App\Models\Administration;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Administration::all();
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
            'university_id' => 'required|exists:universities,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:administrations',
            'phone' => 'nullable|string|max:15',
        ]);

        $administration = Administration::create($request->all());
        return response()->json($administration, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Administration $administration)
    {
        return $administration;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administration $administration)
    {
        // Not typically used in API controllers
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administration $administration)
    {
        $request->validate([
            'university_id' => 'sometimes|required|exists:universities,id',
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:administrations,email,' . $administration->id,
            'phone' => 'sometimes|nullable|string|max:15',
        ]);

        $administration->update($request->all());
        return response()->json($administration);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administration $administration)
    {
        $administration->delete();
        return response()->json(null, 204);
    }
}
