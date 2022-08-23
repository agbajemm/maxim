<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('customer', [\App\Http\Controllers\CustomerController::class, 'create']);
Route::get('customer', [\App\Http\Controllers\CustomerController::class, 'display']);
Route::post('customer-update', [\App\Http\Controllers\CustomerController::class, 'update']);
Route::post('customer-delete', [\App\Http\Controllers\CustomerController::class, 'delete']);
Route::get('database', [\App\Http\Controllers\CustomerController::class, 'dbInfo']);