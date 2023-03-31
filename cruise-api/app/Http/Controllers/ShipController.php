<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Models\User;
use App\Models\Cruise;
use Illuminate\Http\Request;

class ShipController extends Controller
{
   
    function getShip()
    {
        $Ship = Ship::paginate(5);
        if ($Ship) {
            // Return the port as JSON data
            return response()->json(['Ship' => $Ship]);
        } else {

            return response()->json(['error' => 'Ship not found'], 404);
        }
    }

//get company users

    function getcompany()
    {
        $company = User::where('role', 2)->get();
        if ($company) {
            // Return the port as JSON data
            return response()->json(['company' => $company]);
        } else {

            return response()->json(['error' => 'Ship not found'], 404);
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
    public function show(Ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ship $ship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ship = ship::find($id);
        $Cruise = Cruise::find($id);
        if ($ship) {
            Cruise::where('port_id', $ship->id)->delete();
            $ship->delete();
            return response()->json(['message' => 'Port deleted successfully']);
        } else {
            return response()->json(['message' => 'Port not found'], 404);
        }
    }
}
