<?php

namespace App\Http\Controllers;

use App\Models\Cruise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'picture' => 'required|image',
            'nights_number' => 'required',
            'start_date' => 'required',
            'ship_id' => 'required',
            'port_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $name = $request->get('name');
        $price = $request->get('price');
        $picture = $request->file('picture');
        $nights_number = $request->get('nights_number');
        $start_date = $request->get('start_date');
        $ship_id = $request->get('ship_id');
        $port_id = $request->get('port_id');

        $picturePath = $picture->store('public/pictures'); // store the image file and get the path

        $cruise = new Cruise();
        $cruise->name = $name;
        $cruise->price = $price;
        $cruise->picture = $picturePath; // store the path in the picture field
        $cruise->nights_number = $nights_number;
        $cruise->start_date = $start_date;
        $cruise->ship_id = $ship_id;
        $cruise->port_id = $port_id;

        if ($cruise->save()) {
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
    public function update(Request $request, Cruise $cruise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Cruise = Cruise::find($id);
        if ($Cruise) {
            $Cruise->delete();
            return response()->json(['message' => 'Port deleted successfully']);
        } else {
            return response()->json(['message' => 'Port not found'], 404);
        }
    }
}
