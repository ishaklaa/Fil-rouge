<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BranchController;

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
Route::get('/cashier/history',[OrderController::class,'cashierOrders'])->name('order.history');
Route::get('/cashier/statistics',[OrderController::class,'statistics'])->name('cashier.statistics');

Route::post('/admin/activity',[ActivityController::class,'store'])->name('activities.store');
Route::put('/admin/activity/update/{id}',[ActivityController::class,'update'])->name('activities.update');
/*Route::delete('/admin/activity/delete/{id}',[ActivityController::class,'destroy'])->name('activities.destroy');*/
Route::get('/actvities/show',[ActivityController::class,'show'])->name('activities.index');

Route::get('/admin/branches',[BranchController::class,'index'])->name('branches.index');
Route::post('/admin/branches/store',[BranchController::class,'store'])->name('branches.store');
Route::put('/admin/branch/update/{id}',[BranchController::class,'update'])->name('branches.update');
