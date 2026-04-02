<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[LoginController::class,'show'])->name('login.show');
Route::post('/login',[LoginController::class,'store'])->name('login.store');
/*Route::get('/cashier/activity',[CashierController::class,'index'])->name('cashier.index');*/
Route::get('/cashier/activity',[ActivityController::class,'index'])->name('activity.index');
Route::post('/cashier/{id}',[OrderController::class,'orderIncrease'])->name('cashier.order.increase');
Route::post('/cashier/{id}',[OrderController::class,'orderDecrease'])->name('cashier.order.decrement');
Route::post('/cashier/{id}',[OrderController::class,'removeFromOrder'])->name('cashier.order.remove');
Route::post('/cashier/{id}',[OrderController::class,'setDiscount'])->name('cashier.order.discount');
Route::post('/cashier/{id}',[OrderController::class,'addToOrder'])->name('cashier.order.add');

