<?php

use App\Http\Controllers\CruiseController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ShipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});




Route::get('/cruise', [CruiseController::class,'get_cruise'] );

Route::get('/Admin', [CruiseController::class,'cruiseAdmin'] );
Route::post('/addCruise', [CruiseController::class,'addCruise'] );




Route::get('/AdminP', [PortController::class,'portAdmin'] );
Route::get('/getPort', [PortController::class,'getPort'] );
Route::delete('/destroyPort/{id}', [PortController::class,'destroy'] );
Route::delete('/destroyShip/{id}', [ShipController::class,'destroy'] );
Route::delete('/destroyCruise/{id}', [CruiseController::class,'destroy'] );





Route::get('/getShip', [ShipController::class,'getShip'] );


Route::get('/getcompany', [ShipController::class,'getcompany'] );