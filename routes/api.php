<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/sayhello', function () {
    return response('hello from server');
});

Route::get('/machine-state', [App\Http\Controllers\DashboardController::class, 'getMachineState']);
Route::post('/set-machine-power', [App\Http\Controllers\DashboardController::class, 'setMachinePower']);
Route::post('/set-machine-suhu', [App\Http\Controllers\DashboardController::class, 'setMachineTemperature']);
// get produksi (hari ini, 7 hari ke belakang, dan bulan ini)
Route::get('/get-prod', [App\Http\Controllers\StatsController::class, 'getProd']);
// simpan produksi. params = machineid, weight, timestamp
Route::post('/set-prod', [App\Http\Controllers\StatsController::class, 'setProd']);

// esp
Route::get('/esp-machine-state', [App\Http\Controllers\DashboardController::class, 'espGetMachineState']);
