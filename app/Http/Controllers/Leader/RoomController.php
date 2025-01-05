<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'storageSpaces' => 'required|array',
            'storageSpaces.*.number' => 'required|string|max:50',
            'storageSpaces.*.x' => 'required|integer',
            'storageSpaces.*.y' => 'required|integer',
        ]);

        // 部屋を作成
        $room = Room::create([
            'team_id' => $validated['team_id'],
            'name' => $validated['name'],
            'width' => $validated['width'],
            'height' => $validated['height'],
        ]);

        // 荷物置き場を作成
        foreach ($validated['storageSpaces'] as $space) {
            $room->storageSpaces()->create($space);
        }

        return response()->json(['message' => 'Room and storage spaces saved successfully.']);
    }

}
