<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getParking()
    {
        $Parking = Parking::all();

        // check if any rooms were found
        if ($Parking->isEmpty()) {
            return response()->json(['message' => 'No places found'], 404);
        } else {

            return response()->json(['Parking' => $Parking]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parking $parking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parking $parking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parking $parking)
    {
        //
    }
}
