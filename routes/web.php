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
Route::get('/items', [ItemController::class, 'create'])->name('items');
Route::get('/showItemField', [ItemController::class, 'showItemField'])->name('showItemField');
Route::post('/itemstore', [ItemController::class, 'store'])->name('itemstore');
Route::get('/item-list', [ItemController::class, 'index'])->name('item-list');
Route::get('/edititem/{id?}', [ItemController::class, 'edit'])->name('edititem');
Route::post('/itemupdate', [ItemController::class, 'update'])->name('itemupdate');

Route::get('/customer', [CustomerController::class, 'create'])->name('customer');
Route::post('/customer-store', [CustomerController::class, 'store'])->name('customer-store');

Route::get('/customer-list', [CustomerController::class, 'index'])->name('customer-list');
Route::get('/show-customers',[CustomerController::class,'showCustomers'])->name('show-customers');
// Customer Routes
Route::get('/customer', [CustomerController::class, 'showCustomerPage'])->name('customer');

// Stock Routes
Route::get('/stock', [StockController::class, 'index'])->name('stock');
Route::post('/stockstore', [StockController::class, 'store'])->name('stockstore');
Route::get('/editstock/{id?}', [StockController::class, 'edit'])->name('editstock');
Route::post('/stockupdate', [StockController::class, 'update'])->name('stockupdate');

