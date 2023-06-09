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
        $articlePerPage = 5;
        $Ship = Ship::orderBy('name', 'asc')->simplePaginate($articlePerPage);
                $pagesCount = ceil(ship::count() / $articlePerPage);

        if ($Ship) {
            // Return the port as JSON data
            return response()->json(['Ship' => $Ship->items(),
                                    'pagesCount' => $pagesCount]);
        } else {

            return response()->json(['error' => 'Ship not found'], 404);
        }
    }
    function getShipADD()
    {
        $Ship = Ship::all();
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
        $validated = $request->validate([
            'name' => 'string|max:255',
        ]);

        $Ship = new Ship;
        $Ship->name = $validated['name'];
        $Ship->save();

        if ($Ship->save()) {
            return response()->json($Ship, 201);
        } else {
            return response()->json(['error' => 'Port not saved'], 404);
        }
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
