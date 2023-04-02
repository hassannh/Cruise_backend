<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    public function Cruise()
    {
        return $this->belongsTo(Cruise::class);
    }

    public function roomType()
    {
        return $this->hasMany(RoomType::class);
    }
}
