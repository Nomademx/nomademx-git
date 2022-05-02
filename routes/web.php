<?php

use App\Http\Controllers\RealEstateSalesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\NestedSelect;
use Illuminate\Support\Facades\Auth;
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

//Rutas para combobox de Pais/estado/ciudad/colonia
Route::post('/get-states', [SaleController::class, 'getStates'])->name('getStates');
Route::post('/get-cities', [SaleController::class, 'getCities'])->name('getCities');
Route::post('/get-suburbs', [SaleController::class, 'getSuburbs'])->name('getSuburbs');

//Rutas para Venta/Renta/Preventa
Route::resource('/sales', SaleController::class);

//Rutas para usuario
Route::get('/profile', [UserController::class, 'getProfile'])->name('users.getProfile');
Route::get('/agents', [UserController::class, 'getAgents'])->name('users.getAgents');
Route::get('/agents/{user}', [UserController::class, 'getAgent'])->name('users.getAgent');
Route::resource('/admin/users', UserController::class);



