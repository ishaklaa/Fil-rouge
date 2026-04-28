<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['roleAndStatusCheck:admin'])->group(function () {
    Route::post('/admin/activity',[ActivityController::class,'store'])->name('activities.store');
    Route::put('/admin/activity/update/{id}',[ActivityController::class,'update'])->name('activities.update');
    Route::get('/actvities/show',[ActivityController::class,'show'])->name('activities.index');
    Route::get('/admin/branches',[BranchController::class,'index'])->name('branches.index');
    Route::post('/admin/branches/store',[BranchController::class,'store'])->name('branches.store');
    Route::put('/admin/branch/update/{id}',[BranchController::class,'update'])->name('branches.update');
    Route::get('/admin/profiles',[UserController::class,'index'])->name('profiles.index');
    Route::post('/admin/Profiles/store',[UserController::class,'store'])->name('profiles.store');
    Route::put('/admin/profiles/{id}', [UserController::class, 'update'])->name('profiles.update');

});

Route::middleware(['roleAndStatusCheck:cashier'])->group(function () {
    Route::get('/cashier/dashboard',[CashierController::class,'index'])->name('cashier.dashboard');
    Route::get('/cashier/activity',[ActivityController::class,'index'])->name('activity.index');
    Route::post('/cashier/checkout',[OrderController::class,'store']);

});
Route::middleware(['roleAndStatusCheck:cashier,admin,supervisor'])->group(function () {
    Route::post('/cashier/receipt',[TaskController::class,'getTaks']);
    Route::get('/cashier/history',[OrderController::class,'cashierOrders'])->name('order.history');

});
Route::middleware(['roleAndStatusCheck:admin,supervisor'])->group(function () {
    Route::get('/cashier/statistics',[OrderController::class,'statistics'])->name('cashier.statistics');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

});
Route::middleware(['CheckAccountStatus'])->group(function () {
    Route::post('/login',[LoginController::class,'store'])->name('login.store');

});
Route::get('/login',[LoginController::class,'show'])->name('login.show');
Route::get('/logout',[LoginController::class,'logout']);


