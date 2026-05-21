<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Api\ProductApiController;
//use App\Http\Controllers\Api\OrderApiController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Product API Routes
|--------------------------------------------------------------------------
*/

//Route::get('/products', [ProductApiController::class, 'index']);
//Route::get('/products/{id}', [ProductApiController::class, 'show']);
//Route::post('/products', [ProductApiController::class, 'store']);
//Route::put('/products/{id}', [ProductApiController::class, 'update']);
//Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| POS Sales Route
|--------------------------------------------------------------------------
*/

//Route::post('/pos/sale', [OrderApiController::class, 'storeSale']);

/*
|--------------------------------------------------------------------------
| Orders API Routes
|--------------------------------------------------------------------------
*/

//Route::get('/orders', [OrderApiController::class, 'index']);
//Route::delete('/orders/{id}', [OrderApiController::class, 'destroy']);