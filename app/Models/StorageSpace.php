<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'number',
        'x',
        'y',
        'width',
        'height'
    ];

    // 部屋とのリレーション
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function activeReservations()
    {
        return $this->reservations()->where('status', 'active');
    }
}
