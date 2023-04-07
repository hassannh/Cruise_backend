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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'picture' => 'required|image',
            'nights_number' => 'required|numeric',
            'start_date' => 'required|date',
            'ship_id' => 'required|exists:ships,id',
            'port_id' => 'required|exists:ports,id',
        ]);
    
        $picturePath = $request->file('picture')->store('public/pictures');
    
        $cruise = new Cruise;
        $cruise->name = $validated['name'];
        $cruise->price = $validated['price'];
        $cruise->picture = Storage::url($picturePath);
        $cruise->nights_number = $validated['nights_number'];
        $cruise->start_date = $validated['start_date'];
        $cruise->ship_id = $validated['ship_id'];
        $cruise->port_id = $validated['port_id'];
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
