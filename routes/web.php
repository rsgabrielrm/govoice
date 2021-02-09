<?php

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
    return view('auth.register');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', \App\Http\Controllers\DashboardController::class)
        ->name('dashboard');

    Route::get('customer/{customer}/numbers', \App\Http\Controllers\NumbersByCustomerController::class)
        ->name('number_by_customer');

    Route::resource('customers', \App\Http\Controllers\CustomerController::class)
        ->except('show');

    Route::resource('numbers', \App\Http\Controllers\NumberController::class)
        ->except('show');

    Route::prefix('number/{number}')->name('number.')->group(function () {
        Route::resource('preferences', \App\Http\Controllers\NumberPreferenceController::class)
            ->except('show');
    });

});




require __DIR__.'/auth.php';
