<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;

class RoomController extends Controller
{
    public function index()
    {

        $rooms = Room::with('roomtype')->latest()->get();
        $roomtypes = RoomType::all();
        $activeRoomTypes = RoomType::count();

        return view('dashboard', compact('rooms', 'roomtypes', 'activeRoomTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number',
            'status' => 'required|string|max:255',
            'room_type_id' => 'required|exists:room_types,id',
        ]);

        Room::create($validated);
        
        return redirect()->back()->with('success', 'Room added successfully.');
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'room_type_id' => 'required|exists:room_types,id',
        ]);

        $room->update($validated);
        return redirect()->back()->with('success', 'Room updated successfully.');
    }
    
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('success', 'Room deleted successfully.');
    }
}
