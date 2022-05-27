<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::match(['GET', 'POST'], '/login', [App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
    Route::match(['GET', 'POST'], '/register', [App\Http\Controllers\Auth\AuthController::class, 'register'])->name('register');
});


// Authenticated Users / Admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [App\Http\Controllers\StatsController::class, 'index'])->name('stats');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');

    // update machine id bound (bound or unbound)
    Route::post('/bond', [App\Http\Controllers\SettingsController::class, 'updateBond'])->name('bond');
    // change password
    Route::post('/changepassword', [App\Http\Controllers\SettingsController::class, 'changePassword'])->name('changepassword');
    // delete machine id
    Route::post('/addmachineid', [App\Http\Controllers\SettingsController::class, 'addMachineId'])->name('addmachineid');
    // delete machine id
    Route::post('/deletemachineid', [App\Http\Controllers\SettingsController::class, 'deletemachineid'])->name('deletemachineid');


    Route::get('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
});

// run command from route
Route::prefix('run')->group(function () {
    // show php info
    Route::get('/phpinfo', function () {
        dd(phpinfo());
    });
    // cache route
    Route::get('/cache-route', function () {
        Artisan::call('route:cache');
    });
    // cache config
    Route::get('/cache-config', function () {
        Artisan::call('config:cache');
    });
    // optimize
    Route::get('/optimize', function () {
        Artisan::call('optimize');
    });
});
