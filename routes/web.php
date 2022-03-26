<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
// site crud
Route::get('/site', [SiteController::class, 'index'])->name('site');
Route::post('/sitestore', [SiteController::class, 'store'])->name('sitestore');
// supplier crud
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
Route::get('/customer', [CustomerController::class, 'showCustomerPage'])->name('customer');
