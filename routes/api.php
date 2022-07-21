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

Route::get('/ayakan-state', [App\Http\Controllers\DashboardController::class, 'getAyakanState']);

Route::post('/set-machine-power', [App\Http\Controllers\DashboardController::class, 'setMachinePower']);

Route::post('/set-ayakan-power', [App\Http\Controllers\DashboardController::class, 'setAyakanPower']);

Route::post('/set-machine-suhu', [App\Http\Controllers\DashboardController::class, 'setMachineTemperature']);
// get produksi (hari ini, 7 hari ke belakang, dan bulan ini)
Route::get('/get-prod', [App\Http\Controllers\StatsController::class, 'getProd']);
// simpan produksi dari esp8266. params = machineid, weight, timestamp
Route::post('/set-prod', [App\Http\Controllers\StatsController::class, 'setProd']);
// update berat yang terdeteksi dari load cell
Route::get('/get-weight', [App\Http\Controllers\DashboardController::class, 'getWeight'])->name('getweight');
// dapatkan berat yang terdeteksi dari load cell
Route::post('/set-weight', [App\Http\Controllers\DashboardController::class, 'setWeight'])->name('setweight');
// simpan produksi dari web
Route::post('/simpanproduksi', [App\Http\Controllers\StatsController::class, 'simpanProduksi'])->name('simpanproduksi');

// esp
Route::get('/esp-machine-state', [App\Http\Controllers\DashboardController::class, 'espGetMachineState']);
Route::get('/esp-machine-todayprod', [App\Http\Controllers\DashboardController::class, 'espGetMachineTodayProd']);

