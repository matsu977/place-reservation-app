<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Leader\DashboardController as LeaderDashboardController;
use App\Http\Controllers\Leader\RoomController as LeaderRoomController;
use App\Http\Controllers\Leader\ReservationController as LeaderReservationController;
use App\Http\Controllers\Leader\MemberController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\RoomController as MemberRoomController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\Leader\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 認証関連
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('reset-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');

// チーム管理者用ルート
Route::middleware(['auth', 'role:team_leader'])->prefix('leader')->name('leader.')->group(function () {
    Route::get('/dashboard', [LeaderDashboardController::class, 'index'])->name('leaderdashboard');
    
    Route::resource('rooms', LeaderRoomController::class);
    Route::resource('reservations', LeaderReservationController::class);
    Route::resource('members', MemberController::class);
});

// メンバー用ルート（チーム管理者もアクセス可能）
Route::middleware(['auth', 'role:member,team_admin'])->group(function () {
    Route::get('dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('rooms', [MemberRoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/{room}', [MemberRoomController::class, 'show'])->name('rooms.show');
    
    // マイページ関連
    Route::prefix('my-page')->name('mypage.')->group(function () {
        Route::get('/', [MyPageController::class, 'index'])->name('index');
        Route::get('reservations', [MyPageController::class, 'reservations'])->name('reservations');
        Route::get('account-settings', [MyPageController::class, 'accountSettings'])->name('account-settings');
        Route::patch('account-settings', [MyPageController::class, 'updateAccount'])->name('account-settings.update');
    });
});

// チームリーダー用ルート
Route::middleware(['auth'])->prefix('leader')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('leader.dashboard');
});

require __DIR__.'/auth.php';
