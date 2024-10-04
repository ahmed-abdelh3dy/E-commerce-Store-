<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\DelvieriesController;
use App\Http\Controllers\Api\ProductsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::apiResource('products',ProductsApiController::class);
// 
Route::prefix('v1')->group(function () {
    Route::apiResource('products', ProductsApiController::class);
});


// Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
//     Route::apiResource('products', ProductsApiController::class);
// });



Route::post('auth/products', [AccessTokenController::class, 'store'])->middleware('guest:sanctum');

Route::delete('auth/products/{token?}', [AccessTokenController::class, 'destroy'])
    ->middleware('auth:sanctum');

Route::put('delivery/{delivery}', [DelvieriesController::class, 'update']);
Route::get('delivery/{delivery}', [DelvieriesController::class, 'show']);
