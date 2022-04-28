<?php

use App\Http\Controllers\RealEstateSalesController;
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

Route::resource('/sales', RealEstateSalesController::class,['names' => 'sales']);

Route::resource('/admin/users', UserController::class);
Route::get('/agents', [UserController::class, 'getAgents'])->name('users.getAgents');
Route::get('/agents/{user}', [UserController::class, 'getAgent'])->name('users.getAgent');


// Route::get('/users/profile/', [UserController::class, 'getProfile'])->name('users.profile');
// ruta user/agent


Route::post('/get-states', [RealEstateSalesController::class, 'getStates'])->name('getStates');
Route::post('/get-cities', [RealEstateSalesController::class, 'getCities'])->name('getCities');
Route::post('/get-suburbs', [RealEstateSalesController::class, 'getSuburbs'])->name('getSuburbs');


