<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Dashboard\CarController;
use App\Http\Controllers\Dashboard\DriverController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\{ContactController,
    Dashboard\ConditionController,
    Dashboard\ProfileRentalController,
    Dashboard\RentalController,
    HomeController as LandingHomeController,
    TransactionController};
use App\Http\Controllers\Dashboard\RentcarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PunishmentController;
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
   return view('landing.pages.home.index');
});
/* Route::get('/edit', function () {
   return view('dashboard.editProfile.index');
}); */

Route::name('landing.')->group(function() {
    Route::get('/', [LandingHomeController::class, 'index'])->name('home');

    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    Route::middleware('auth')->group(function() {
        Route::get('/search/', [LandingHomeController::class, 'searchRentals'])->name('searchRentals');
        Route::get('/detail/{car}', [LandingHomeController::class, 'detailRent'])->name('detailRent');
        Route::post('/bayar', [LandingHomeController::class, 'bayar'])->name('bayar');
        Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    });

    Route::post('/payment-notification-handling', [LandingHomeController::class, 'handleAfterPayment'])->name('handlingPayment');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('profile/{id}/edit', [ProfileRentalController::class, 'edit'])->name('edit-profile');
    Route::post('profile/{id}/update', [ProfileRentalController::class, 'update'])->name('update-profile');


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
            'rental' => RentalController::class,
        ]);
        Route::get('/transaksi', [TransactionController::class, 'transaksiRental'])->name('transaksi');
        Route::get('/denda', [PunishmentController::class, 'index'])->name('denda');
        Route::post('/storeDenda', [PunishmentController::class, 'store'])->name('storeDenda');
        Route::get('/setSelesai/{rent}', [TransactionController::class, 'setSelesai'])->name('setSewaSelesai');
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
