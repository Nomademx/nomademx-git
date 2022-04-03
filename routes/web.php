<?php

use App\Http\Controllers\RealEstateSalesController;
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
    return view('home');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('/ventas', RealEstateSalesController::class,['names' => 'sales']);

Route::post('/fetch-states', [RealEstateSalesController::class, 'getStates']);
//Route::post('/fetch-cities', [RealEstateSalesController::class, 'getCities']);
