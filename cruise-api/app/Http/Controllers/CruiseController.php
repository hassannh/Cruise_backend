<?php

namespace App\Http\Controllers;

use App\Models\Cruise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function get_cruise()
    {
       
            $cruise_data = Cruise::paginate(5);
            echo json_encode($cruise_data);
            
        }
     
        
    /**
     * Store a newly created resource in storage.
     */
    public function addCruise(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'picture' => 'mimes:jpeg,png',
            'nights_number' => 'integer',
            'start_date' => 'date',
            'ship_id' => 'exists:ships,id',
            'port_id' => 'exists:ports,id',
        ]);
    
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('public/pictures');
        } 
        $cruise = new Cruise;
        
        if (array_key_exists('name', $validated)) {
            $cruise->name = $validated['name'];
        }
        if (array_key_exists('price', $validated)) {
        $cruise->price = $validated['price'];
        }
        $cruise->picture = $picturePath ;
        
        if (array_key_exists('nights_number', $validated)) {
        $cruise->nights_number = $validated['nights_number'];
        }
        if (array_key_exists('start_date', $validated)) {
        $cruise->start_date = $validated['start_date'];
        }
        if (array_key_exists('ship_id', $validated)) {
        $cruise->ship_id = $validated['ship_id'];
        }
        if (array_key_exists('port_id', $validated)) {
        $cruise->port_id = $validated['port_id'];
        }

        $cruise->save();

        if ($cruise->save()) {
            return response()->json($cruise, 201);
        } else {
            return response()->json(['error' => 'Cruise not saved'], 404);
        }
    
    }


    /**
     * Display the specified resource.
     */
    public function cruiseAdmin(Cruise $cruises)
    {
        $cruises = Cruise::join('ports', 'cruises.id', '=', 'ports.id')
        ->select('cruises.*', 'ports.name as port_name')
        ->get();

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
    public function show($id)
    {
        $cruise_data = Cruise::find($id);
            return $cruise_data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Cruise = Cruise::find($id);
        if ($Cruise) {
            $Cruise->delete();
            return response()->json(['message' => 'cruise deleted successfully']);
        } else {
            return response()->json(['message' => 'cruise not found'], 404);
        }
    }
}
