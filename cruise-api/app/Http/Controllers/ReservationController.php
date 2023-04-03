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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'cruise_id' => 'required|integer',
            'room_id' => 'required|integer',
            'parking_id' => 'nullable|integer',
            'price' => 'required|numeric',
        ]);

        // Create a new reservation model instance with the validated data
        $reservation = new Reservation([
            'user_id' => $validatedData['user_id'],
            'cruise_id' => $validatedData['cruise_id'],
            'room_id' => $validatedData['room_id'],
            'parking_id' => $validatedData['parking_id'],
            'price' => $validatedData['price'],
        ]);

        // Save the new reservation to the database
        $reservation->save();

        // Return a response indicating success
        return response()->json([
            'message' => 'Reservation added successfully',
            'reservation' => $reservation,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getReservation($id)
    {
        // find reservation with given ID
        $reservation = Reservation::find($id);

        // check if reservation exists
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        // return reservation data
        return response()->json($reservation);
    }


    /**
     * Display reservation by id user
     */


public function getReservationsByUserId($user_id)
{
    // find reservations with given user ID
    $reservations = Reservation::where('user_id', $user_id)->get();

    // check if any reservations were found
    if ($reservations->isEmpty()) {
        return response()->json(['message' => 'No reservations found for this user'], 404);
    }
    
    // retrieve the corresponding cruise names, start dates, and pictures for the reservations
    $cruise_data = Cruise::whereIn('id', $reservations->pluck('cruise_id'))
        ->select(['id', 'name', 'start_date', 'picture','nights_number','price'])
        ->get()
        ->keyBy('id');

    // merge the cruise data into the reservations collection
    $reservations = $reservations->map(function ($reservation) use ($cruise_data) {
        $cruise = $cruise_data[$reservation->cruise_id];
        $reservation['cruise_name'] = $cruise->name;
        $reservation['cruise_start_date'] = $cruise->start_date;
        $reservation['cruise_picture'] = $cruise->picture;
        $reservation['nights_number'] = $cruise->nights_number;
        $reservation['price'] = $cruise->price;
        return $reservation;
    });

    // return reservations data
    return response()->json(['reservations' => $reservations]);
}



    /**
     * Update the specified resource in storage.
     */
    public function updateReservation(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'cruise_id' => 'required|integer',
            'room_id' => 'required|integer',
            'parking_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // find reservation with given ID
        $reservation = Reservation::find($id);

        // check if reservation exists
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        // update reservation data
        $reservation->user_id = $validatedData['user_id'];
        $reservation->cruise_id = $validatedData['cruise_id'];
        $reservation->room_id = $validatedData['room_id'];
        $reservation->parking_id = $validatedData['parking_id'];
        $reservation->price = $validatedData['price'];
        $reservation->save();

        // return success response
        return response()->json(['message' => 'Reservation updated successfully']);
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
