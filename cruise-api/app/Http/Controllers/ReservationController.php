<?php

namespace App\Http\Controllers;

use App\Models\Cruise;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function addReservation(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Reservation = Reservation::find($id);
        $Cruise = Cruise::find($id);
        if ($Reservation) {
            Cruise::where('port_id', $Reservation->id)->delete();
            $Reservation->delete();
            return response()->json(['message' => 'Port deleted successfully']);
        } else {
            return response()->json(['message' => 'Port not found'], 404);
        }
    }
}
