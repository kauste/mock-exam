<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
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
//Countries
Route::middleware('role:admin')->group(function () {
Route::get('/country', [CountryController::class, 'index'])->name('country-list');
Route::get('/country/edit/{country}', [CountryController::class, 'edit'])->name('country-edit');
Route::put('/country/edit/{country}', [CountryController::class, 'update'])->name('country-update');
Route::get('/country/create', [CountryController::class, 'create'])->name('country-create');
Route::post('/country/store', [CountryController::class, 'store'])->name('country-store');
Route::delete('/country/delete/{country}', [CountryController::class, 'destroy'])->name('country-delete');
//Hotels
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel-list');
Route::get('/hotel/edit/{hotel}', [HotelController::class, 'edit'])->name('hotel-edit');
Route::put('/hotel/edit/{hotel}', [HotelController::class, 'update'])->name('hotel-update');
Route::get('/hotel/create', [HotelController::class, 'create'])->name('hotel-create');
Route::post('/hotel/store', [HotelController::class, 'store'])->name('hotel-store');
Route::delete('/hotel/delete/{hotel}', [HotelController::class, 'destroy'])->name('hotel-delete');
//Orders
Route::get('/all-orders', [OrderController::class, 'index'])->name('all-orders-list');
Route::put('/change-state/{order}', [OrderController::class, 'changeState'])->name('change-state');
});
//Front
Route::get('/front/hotel-list', [FrontController::class, 'show'])->name('front-hotel-list');
Route::post('order-vacation/{hotel}', [OrderController::class, 'orderVacation'])->name('order-vacation');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my-orders');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

