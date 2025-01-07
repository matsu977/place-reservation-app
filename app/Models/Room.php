<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'width',
        'height'
    ];

    public function storageSpaces()
    {
        return $this->hasMany(StorageSpace::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
