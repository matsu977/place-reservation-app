<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::where('team_id', auth()->user()->team_id)
            ->with('storageSpaces')
            ->paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'width' => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
        ]);

        $room = new Room($validated);
        $room->team_id = auth()->user()->team_id;
        $room->save();

        return redirect()->route('admin.rooms.index')
            ->with('success', '部屋を登録しました。');
    }

    public function show(Room $room)
    {
        // チーム所属確認
        if ($room->team_id !== auth()->user()->team_id) {
            abort(403);
        }

        return view('admin.rooms.show', compact('room'));
    }

    // 他のメソッド（edit, update, destroy）も同様に実装
}
