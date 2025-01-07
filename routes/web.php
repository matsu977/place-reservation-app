<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Models\Room; 
use App\Http\Controllers\TeamController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth'])->group(function () { 

    Route::get('/rooms/{room}/reservation', [ReservationController::class, 'showReservation'])
        ->name('rooms.reservation');
    Route::post('/reservations', [ReservationController::class, 'reserve'])
    ->name('reservations.store');
    Route::post('/storage-spaces/{storageSpace}/cancel', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel');
});

Route::get('/rooms/create', [RoomController::class, 'create'])->middleware(['auth', 'verified'])->name('rooms.create');
 
// チーム関連
Route::middleware(['auth'])->group(function () {
    // チーム未所属ユーザー向けルート
    Route::get('/team/select', [TeamController::class, 'selectForm'])->name('team.select');
    Route::get('/team/create', [TeamController::class, 'createForm'])->name('team.create');
    Route::post('/team/create', [TeamController::class, 'store'])->name('team.store');
    Route::get('/team/join', [TeamController::class, 'joinForm'])->name('team.join');
    Route::post('/team/join', [TeamController::class, 'join'])->name('team.join.process');


    
    /*
    // チーム所属済みユーザー向けルート
    Route::middleware(['require.team'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        // 他のルート...
    });
    */
});



require __DIR__.'/auth.php';
