<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReadingsController;
use App\Models\Readings;
use App\Http\Controllers\SensorsController;
use App\Models\Sensors;
use App\Http\Controllers\ControllersController;
use App\Models\Controllers;
use App\Http\Controllers\ConnectionsController;
use App\Models\Connections;
use App\Http\Controllers\TagsController;
use App\Models\IoTTags;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
Controllers API for IoT
*/
Route::get('/controllers', [ControllersController::class, 'index']);
Route::get('/controllers/{id}', [ControllersController::class, 'show']);
Route::put('/controllers/{id}', [ControllersController::class, 'update']);
Route::post('/controllers/{id}', [ControllersController::class, 'update']);
Route::delete('/controllers/{id}', [ControllersController::class, 'destroy']);
Route::post('/controllers', [ControllersController::class, 'create']);

/*
Sensors API for IoT -> controllers
*/
Route::get('/sensors', [SensorsController::class, 'index']);
Route::get('/sensors/{id}', [SensorsController::class, 'show']);
Route::put('/sensors/{id}', [SensorsController::class, 'update']);
Route::delete('/sensors/{id}', [SensorsController::class, 'destroy']);
Route::post('/sensors', [SensorsController::class, 'create']);
Route::get('/sensors/controllers/{id}', [SensorsController::class, 'showConnectedToController']);

//readings of sensors
Route::get('/readings/{limit}/sensor/{id}', [ReadingsController::class, 'showReadingsFromSensor']);
Route::resource('readings', ReadingsController::class);

Route::get('/iot/token/{id}', [TagsController::class, 'show']);
Route::put('/iot/token', [TagsController::class, 'update']);
Route::resource('iot/token', TagsController::class);
