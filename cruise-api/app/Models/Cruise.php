<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{
    use HasFactory;


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

    // public function getCruises()
    // {
    //     $cruises = Cruise::orderBy('start_date')->simplePaginate(10);

    //     return view('cruises.get_cruise', ['cruises' => $cruises]);
    // }
}
