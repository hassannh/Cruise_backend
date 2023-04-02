<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    public function Cruise()
    {
        return $this->belongsTo(Cruise::class);
    }

    public function ship()
    {
        return $this->belongsTo(ship::class);
    }
}
