<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function getRoom_type()
    // {
    //     $room = Room::all();

    //      // check if any rooms were found
    // if ($room->isEmpty()) {
    //     return response()->json(['message' => 'No reservations found for this user'], 404);
    // }
    
    // // retrieve the corresponding room names, and price for the room
    // $Room_data = Room::whereIn('id', $room->pluck('room_type_id'))
    //     ->select(['id', 'name', 'price'])
    //     ->get()
    //     ->keyBy('id');

    //     $room = $room->map(function ($room) use ($Room_data) {
    //         $room = $Room_data[$Room_data->room_type_id];
    //         $room['room_name'] = $room->name;
    //         $room['room_price'] = $room->price;

    //         return response()->json(['room' => $room]);
    //     });
    // }

    public function getRoom_type()
{
    $rooms = Room::all();

    // check if any rooms were found
    if ($rooms->isEmpty()) {
        return response()->json(['message' => 'No rooms found'], 404);
    }
    
    // retrieve the corresponding room names and prices
    $roomData = RoomType::whereIn('id', $rooms->pluck('room_type_id'))
        ->select(['id', 'name', 'price'])
        ->get()
        ->keyBy('id');

    $response = $rooms->map(function ($room) use ($roomData) {
        $data = $roomData[$room->room_type_id];
        $room->room_name = $data->name;
        $room->room_price = $data->price;
        return $room;
    });

    return response()->json(['rooms' => $response]);
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
    public function show(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
