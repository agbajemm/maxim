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
    return view('welcome');
});
Route::get('/dashboard', [\App\Http\Controllers\CustomerController::class, 'index'])->middleware(['auth'])->name('dashboard');;
Route::post('customer', [\App\Http\Controllers\CustomerController::class, 'create'])
        ->name('customer.create');
Route::get('/customer/{id}', [\App\Http\Controllers\CustomerController::class, 'show'])->middleware(['auth'])
        ->name('customer.view');
Route::post('customer/{id}', [\App\Http\Controllers\CustomerController::class, 'createProfile'])
        ->name('create.profile');

require __DIR__.'/auth.php';
