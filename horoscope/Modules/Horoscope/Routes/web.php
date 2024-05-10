<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['language'])->group(function () {
    Route::prefix('horoscope')->group(function () {
        Route::get('', 'HoroscopeController@index')->name('horoscope-form');
        Route::post('/predict', 'HoroscopeController@predict')->name('horoscope-submit');
        Route::post('/preview', 'HoroscopeController@preview')->name('horoscope-pdf-review');
        Route::post('/download', 'HoroscopeController@download')->name('horoscope-pdf-download');
    });
});