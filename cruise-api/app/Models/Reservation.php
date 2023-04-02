<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Reservation extends Pivot
{
    use HasFactory;

    public function Cruise()
    {
        return $this->belongsTo(Cruise::class);
    }
}
