<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\StorageSpace;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function showReservation(Room $room)
    {
        $storageSpaces = $room->storageSpaces()
            ->with(['reservations' => function($query) {
                $query->where('status', 'active');
            }])
            ->get()
            ->map(function ($space) {
                return [
                    'id' => $space->id,
                    'number' => $space->number,
                    'x' => $space->x,
                    'y' => $space->y,
                    'width' => $space->width,
                    'height' => $space->height,
                    'hasActiveReservation' => $space->reservations->isNotEmpty()
                ];
            });

        return view('rooms.reservation', compact('room', 'storageSpaces'));
    }

    public function reserve(Request $request)
    {
        $validated = $request->validate([
            'storage_space_id' => 'required|exists:storage_spaces,id',
            'start_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:1000'
        ]);

        // 既存の予約がないかチェック
        $hasExistingReservation = Reservation::where('storage_space_id', $validated['storage_space_id'])
            ->where('status', 'active')
            ->exists();

        if ($hasExistingReservation) {
            return back()->with('error', 'この荷物置き場は既に予約されています。');
        }

        $reservation = Reservation::create([
            'storage_space_id' => $validated['storage_space_id'],
            'user_id' => auth()->id(),
            'start_date' => $validated['start_date'],
            'status' => 'active',
            'notes' => $validated['notes']
        ]);

        return redirect()->back()->with('success', '予約が完了しました');
    }

    public function cancel(Request $request, StorageSpace $storageSpace)
{
    $reservation = Reservation::where('storage_space_id', $storageSpace->id)
        ->where('status', 'active')
        ->where('user_id', auth()->id())  // 予約者本人かチェック
        ->first();

    if (!$reservation) {
        return back()->with('error', '予約が見つからないか、キャンセルする権限がありません。');
    }

    $reservation->update(['status' => 'canceled']);

    return back()->with('success', '予約をキャンセルしました。');
}
}