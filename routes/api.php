<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UtilityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/rajaongkir/province', [UtilityController::class, 'rajaongkirProvince'])->name('api.rajaongkir.province');
Route::get('/rajaongkir/city', [UtilityController::class, 'rajaongkirCity'])->name('api.rajaongkir.city');
Route::post('/rajaongkir/cost', [UtilityController::class, 'rajaongkirCost'])->name('api.rajaongkir.cost');

Route::get('/payment/info', [UtilityController::class, 'paymentInfo'])->name('api.payment.info');
