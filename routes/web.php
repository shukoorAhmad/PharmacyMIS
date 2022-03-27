<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockController;
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
Route::get('/editsite/{id?}', [SiteController::class, 'edit'])->name('editsite');
Route::post('/siteUpdate', [SiteController::class, 'update'])->name('siteUpdate');
// supplier crud
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
Route::post('/supplierstore', [SupplierController::class, 'store'])->name('supplierstore');
Route::get('/supplieredit/{id?}', [SupplierController::class, 'edit'])->name('supplieredit');
Route::post('/supplierupdate', [SupplierController::class, 'update'])->name('supplierupdate');
// items crud
Route::get('/items', [ItemController::class, 'index'])->name('items');


Route::get('/customer', [CustomerController::class, 'showCustomerPage'])->name('customer');

// Stock Routes
Route::get('/stock', [StockController::class, 'index'])->name('stock');
Route::post('/stockstore', [StockController::class, 'store'])->name('stockstore');
Route::get('/editstock/{id?}', [StockController::class, 'edit'])->name('editstock');
Route::post('/stockupdate', [StockController::class, 'update'])->name('stockupdate');
