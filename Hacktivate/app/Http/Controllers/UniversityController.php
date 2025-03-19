<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all universities
        $universities = University::with(['clubs', 'administrations'])->get();
        return response()->json($universities);
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
            'name' => 'required|string|max:255|unique:universities,name',
            'contact_email' => 'nullable|email',
        ]);

        $university = University::create($request->all());
        return response()->json($university, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        return response()->json($university);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:universities,name,' . $university->id,
            'contact_email' => 'nullable|email',
        ]);

        $university->update($request->all());
        return response()->json($university);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $university->delete();
        return response()->json(null, 204);
    }
}
