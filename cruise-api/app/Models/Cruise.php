<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{
    use HasFactory;

    public function passage()
    {
        return $this->hasMany(Passage::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

    public function port()
    {
        return $this->hasMany(Port::class);
    }

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    
}
