<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Dashboard\CarController;
use App\Http\Controllers\Dashboard\DriverController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\{Dashboard\ConditionController,
    Dashboard\ProfileRentalController,
    HomeController as LandingHomeController};
use App\Http\Controllers\Dashboard\RentcarController;
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

//Route::get('/', function () {
//    return view('landing.pages.home.index');
//});

Route::name('landing.')->group(function() {
    Route::get('/', [LandingHomeController::class, 'index'])->name('home');
    Route::get('/search/', [LandingHomeController::class, 'searchRentals'])->name('searchRentals');
    Route::get('/detail/{car}', [LandingHomeController::class, 'detailRent'])->name('detailRent');
    Route::post('/bayar', [LandingHomeController::class, 'bayar'])->name('bayar');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function() {

        Route::resources([
            'rentcars' => RentcarController::class,
        ]);
    });

    Route::middleware(['role:rental'])->prefix('rental')->name('rental.')->group(function() {

        Route::resources([
            'cars' => CarController::class,
            'drivers' => DriverController::class,
            'conditions' => ConditionController::class,
            'rental' => ProfileRentalController::class,
        ]);
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
