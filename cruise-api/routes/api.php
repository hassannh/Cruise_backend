<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\CruiseController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ReservationController;


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




//cruise//
Route::get('/cruise', [CruiseController::class,'get_cruise'] ); 
Route::get('/Admin', [CruiseController::class,'cruiseAdmin'] )->middleware('auth');
Route::post('/addCruise', [CruiseController::class,'addCruise'] )->middleware('auth');
Route::delete('/destroyCruise/{id}', [CruiseController::class,'destroy'] )->middleware('auth');
Route::get('/show/{id}', [CruiseController::class,'show'] )->middleware('auth');




//Reservation//
Route::post('/addReservation/{id}', [ReservationController::class,'addReservation'] )->middleware('auth');
Route::get('/getReservation/{id}', [ReservationController::class,'getReservation'] )->middleware('auth');
Route::get('/tickets/{id}', [ReservationController::class,'getReservationsByUserId'] )->middleware('auth');
Route::post('/updateReservation/{id}', [ReservationController::class,'updateReservation'] )->middleware('auth');



//port//
Route::get('/AdminP', [PortController::class,'portAdmin'] )->middleware('auth');
Route::get('/getPort', [PortController::class,'getPort'] )->middleware('auth');
Route::delete('/destroyPort/{id}', [PortController::class,'destroy'] )->middleware('auth');



//ship//

Route::get('/getShip', [ShipController::class,'getShip'] )->middleware('auth');
Route::get('/getShipADD', [ShipController::class,'getShipADD'] )->middleware('auth');
Route::get('/getcompany', [ShipController::class,'getcompany'] )->middleware('auth');
Route::delete('/destroyShip/{id}', [ShipController::class,'destroy'] )->middleware('auth');




//room//
Route::get('/getRoom_type', [RoomController::class,'getRoom_type'] );

Route::get('/getRoom_Id/{roomTypeId}', [RoomController::class,'show'] );




//parking//
Route::get('/getParking', [ParkingController::class,'getParking'] );