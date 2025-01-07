<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ログインユーザーのteam_idに基づいて部屋を取得
        $rooms = Room::where('team_id', auth()->user()->team_id)
                    ->with('storageSpaces') // N+1問題を避けるためにEagerロード
                    ->get();

        return view('dashboard', compact('rooms'));
    }
}