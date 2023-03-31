<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Cruise;
use Illuminate\Http\Request;

class PortController extends Controller
{


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
    public function portAdmin()
    {
        $port = port::paginate(5);
        if ($port) {
            // Return the port as JSON data
            return response()->json(['port' => $port]);
        } else {

            return response()->json(['error' => 'port not found'], 404);
        }
    }

    public function getPort()
    {
        $port = port::all();
        if ($port) {
            // Return the port as JSON data
            return response()->json(['port' => $port]);
        } else {

            return response()->json(['error' => 'port not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Port $port)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $port = Port::find($id);
        $Cruise = Cruise::find($id);
        if ($port) {
            Cruise::where('port_id', $port->id)->delete();
            $port->delete();
            return response()->json(['message' => 'Port deleted successfully']);
        } else {
            return response()->json(['message' => 'Port not found'], 404);
        }
    }
}
