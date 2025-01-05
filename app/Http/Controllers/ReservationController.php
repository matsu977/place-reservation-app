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

    public function reserve(Request $request, Room $room)
    {
        // 予約処理のロジックは前回のコードと同じ
    }
}