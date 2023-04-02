<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Dashboard\HomeController;
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

Route::get('/', function () {
    return view('landing.pages.home.index');
});

Route::name('landing.')->group(function() {
    Route::get('/about', [AboutController::class, 'index'])->name('about');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resources([
        'rentcars' => RentcarController::class,
    ]);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
