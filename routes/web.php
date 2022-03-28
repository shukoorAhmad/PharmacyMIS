<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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

// Customer Routes
Route::get('/customer', [CustomerController::class, 'create'])->name('customer');
Route::post('/customer-store', [CustomerController::class, 'store'])->name('customer-store');
Route::get('/customer-list', [CustomerController::class, 'index'])->name('customer-list');
Route::get('/show-customers', [CustomerController::class, 'showCustomers'])->name('show-customers');
Route::get('/edit-customer/{id?}', [CustomerController::class, 'edit'])->name('edit-customer');
Route::post('/update-customer', [CustomerController::class, 'update'])->name('update-customer');

// Stock Routes
Route::get('/stock', [StockController::class, 'index'])->name('stock');
Route::post('/stockstore', [StockController::class, 'store'])->name('stockstore');
Route::get('/editstock/{id?}', [StockController::class, 'edit'])->name('editstock');
Route::post('/stockupdate', [StockController::class, 'update'])->name('stockupdate');

// Order Routes
Route::get('/order-list', [OrderController::class, 'index'])->name('order-list');
Route::get('/order', [OrderController::class, 'create'])->name('order');
Route::get('/addNewItem/{id?}', [OrderController::class, 'addNewItem'])->name('addNewItem');
Route::post('/orderItemStore', [OrderController::class, 'store'])->name('orderItemStore');
Route::get('view-order-details/{id}', [OrderController::class, 'view'])->name('view-order-details');
Route::get('edit-order-details/{id}', [OrderController::class, 'edit'])->name('edit-order-details');
Route::post('update-order-details', [OrderController::class, 'update'])->name('update-order-details');
