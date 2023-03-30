<?php

namespace App\Http\Controllers;

use App\Models\Cruise;
use Illuminate\Http\Request;

class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function get_cruise()
    {
        $cruise_data = Cruise::paginate(5);
        echo json_encode ($cruise_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addCruise(Request $request)
    {
        $name = $request->get('name');
        $price = $request->get('price');
        $picture = $request->file('picture');
        $nights_number = $request->get('nights_number');
        $ship_id = $request->get('ship_id');
        $port_id = $request->get('port_id');

            $cruise = new Cruise();
            $cruise->name = $name;
            $cruise->price = $price;
            $cruise->picture = $picture;
            $cruise->nights_number = $nights_number;
            $cruise->ship_id = $ship_id;
            $cruise->port_id = $port_id;
            if ($cruise->save()){
            return response()->json($cruise, 201);
        } else {
            return response()->json(['error' => 'Cruise not found'], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function cruiseAdmin(Cruise $cruises)
    {
        $cruises = Cruise::paginate(5);
        if ($cruises) {
            // Return the cruises as JSON data
            return response()->json(['cruises' => $cruises]);
        } else {
            // Return an error message if the cruises were not found
            return response()->json(['error' => 'Cruises not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cruise $cruise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cruise $cruise)
    {
        //
    }
}
