<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;

class RoomTypeController extends Controller
{
    public function index()
    {

        $roomtypes = RoomType::latest()->get();
        return view('roomtype', compact('roomtypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price_per_night' => 'required|numeric',
        ]);

        RoomType::create($validated);
        return redirect()->back()->with('success', 'Room type added successfully.');
    }

    public function update(Request $request, RoomType $roomtype)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price_per_night' => 'required|numeric',
        ]);
        
        $roomtype->update($validated);
        return redirect()->back()->with('success', 'Room type updated successfully.');
    }
    
    public function destroy(RoomType $roomtype)
    {
        $roomtype->delete();
        return redirect()->back()->with('success', 'Room type deleted successfully.');
    }
}
