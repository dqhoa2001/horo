<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\BookbindingController;

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

Route::middleware('auth:sanctum')->get('/user', static function (Request $request) {
    return $request->user();
});

Route::controller(CouponController::class)->prefix('coupon')->name('coupon')->group(static function () {
    Route::post('get_discount_price', 'getDiscountPrice')->name('get_discount_price');
});

Route::post('bookbinding_result', [BookbindingController::class, 'bookbindingResult'])->name('bookbinding_result');
Route::post('delivery_info', [BookbindingController::class, 'deliveryInfo'])->name('delivery_info');

