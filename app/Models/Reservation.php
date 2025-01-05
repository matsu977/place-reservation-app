<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'storage_space_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
        'notes'
    ];

    public function storageSpace()
    {
        return $this->belongsTo(StorageSpace::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
