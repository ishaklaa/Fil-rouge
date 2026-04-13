<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cashier/dashboard', function () {
    return view('cashierDashboard');
})->middleware('auth')->name('cashier.dashboard');
Route::get('/login',[LoginController::class,'show'])->name('login.show');
Route::post('/login',[LoginController::class,'store'])->name('login.store');
Route::get('/logout',[LoginController::class,'logout']);
/*Route::get('/cashier/activity',[CashierController::class,'index'])->name('cashier.index');*/
Route::get('/cashier/activity',[ActivityController::class,'index'])->name('activity.index');
Route::post('/cashier/checkout',[OrderController::class,'store']);
Route::post('/cashier/receipt',[TaskController::class,'getTaks']);
Route::get('/cashier',[OrderController::class,'cashierOrders'])->name('order.history');

