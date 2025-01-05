<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Models\Room; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['auth'])->group(function () { 
    Route::get('/dashboard', function () { 
        $rooms = Room::with('storageSpaces')->get(); 
        return view('dashboard', compact('rooms')); 
    })->name('dashboard');

    Route::get('/rooms/{room}/reservation', [ReservationController::class, 'showReservation'])
        ->name('rooms.reservation');
    Route::post('/rooms/{room}/reserve', [ReservationController::class, 'reserve'])
        ->name('rooms.reserve');
});

Route::get('/rooms/create', [RoomController::class, 'create'])->middleware(['auth', 'verified'])->name('rooms.create');
 



require __DIR__.'/auth.php';
