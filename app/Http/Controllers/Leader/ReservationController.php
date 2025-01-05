<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show(Room $room)
    {
        // 部屋の情報と荷物置き場の情報を取得
        $storageSpaces = $room->storageSpaces()
            ->with(['activeReservations' => function($query) {
                $query->where('status', 'active');
            }])
            ->get();

        return view('storage-reservations.show', [
            'room' => $room,
            'storageSpaces' => $storageSpaces
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'storage_space_id' => 'required|exists:storage_spaces,id',
            'start_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:1000'
        ]);

        $reservation = StorageReservation::create([
            'storage_space_id' => $validated['storage_space_id'],
            'user_id' => auth()->id(),
            'start_date' => $validated['start_date'],
            'status' => 'active',
            'notes' => $validated['notes']
        ]);

        return redirect()->back()->with('success', '予約が完了しました');
    }
}
