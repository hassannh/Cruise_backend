<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\CruiseController;
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
Route::post('/addCruise', [CruiseController::class,'addCruise'] );
Route::delete('/destroyCruise/{id}', [CruiseController::class,'destroy'] );




//Reservation//
Route::post('/addReservation', [ReservationController::class,'addReservation'] );
Route::get('/getReservation/{id}', [ReservationController::class,'getReservation'] );
Route::get('/getReservationsByUserId/{id}', [ReservationController::class,'getReservationsByUserId'] );
Route::post('/updateReservation/{id}', [ReservationController::class,'updateReservation'] );



//port//
Route::get('/AdminP', [PortController::class,'portAdmin'] );
Route::get('/getPort', [PortController::class,'getPort'] );
Route::delete('/destroyPort/{id}', [PortController::class,'destroy'] );



//ship//

Route::get('/getShip', [ShipController::class,'getShip'] );
Route::get('/getShipADD', [ShipController::class,'getShipADD'] );
Route::get('/getcompany', [ShipController::class,'getcompany'] );
Route::delete('/destroyShip/{id}', [ShipController::class,'destroy'] );

