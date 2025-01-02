<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $teamId = auth()->user()->team_id;

        // チームの統計情報を取得
        $totalRooms = Room::where('team_id', $teamId)->count();
        $totalMembers = User::where('team_id', $teamId)->count();
        $todayReservations = Reservation::whereHas('storageSpace.room', function($query) use ($teamId) {
            $query->where('team_id', $teamId);
        })
        ->whereDate('start_date', Carbon::today())
        ->count();

        // 最近の予約を取得
        $recentReservations = Reservation::with(['user', 'storageSpace.room'])
            ->whereHas('storageSpace.room', function($query) use ($teamId) {
                $query->where('team_id', $teamId);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('leader.dashboard', compact(
            'totalRooms',
            'totalMembers',
            'todayReservations',
            'recentReservations'
        ));
    }
}