<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransferController;
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
Route::post('/orderItemStore', [OrderController::class, 'store'])->name('orderItemStore');
Route::get('/addNewItem', [OrderController::class, 'addNewItem'])->name('addNewItem');
Route::get('view-order-details/{id}', [OrderController::class, 'view'])->name('view-order-details');
Route::get('/edit-order-details/{id}', [OrderController::class, 'edit'])->name('edit-order-details');
Route::post('/update-order-details', [OrderController::class, 'update'])->name('update-order-details');
Route::get('/delete-order-item/{id}', [OrderController::class, 'deleteOrderItem'])->name('delete-order-item');
Route::get('/purchase-order/{id}', [PurchaseController::class, 'purchaseItems'])->name('purchase-order');
// purchase routes
Route::post('/store-purchase', [PurchaseController::class, 'store'])->name('store-purchase');
Route::get('/purchase-list', [PurchaseController::class, 'index'])->name('purchase-list');
Route::get('/purchase', [PurchaseController::class, 'create'])->name('purchase');
Route::get('/add_new_item', [PurchaseController::class, 'add_new_item'])->name('add_new_item');
Route::get('view-purchase-details/{id}', [PurchaseController::class, 'show'])->name('view-purchase-details');

// Seller Routes
Route::get('/seller', [SellerController::class, 'create'])->name('seller');
Route::post('/seller-store', [SellerController::class, 'store'])->name('seller-store');
Route::get('/seller-list', [SellerController::class, 'index'])->name('seller-list');
Route::get('/show-seller', [SellerController::class, 'showSellers'])->name('show-seller');
Route::get('/edit-seller/{id?}', [SellerController::class, 'edit'])->name('edit-seller');
Route::post('/update-seller', [SellerController::class, 'update'])->name('update-seller');
// transfer routes
Route::get('/transfer-list', [TransferController::class, 'index'])->name('transfer-list');
Route::get('/transfer', [TransferController::class, 'create'])->name('transfer');
Route::get('/show-transfer-bills', [TransferController::class, 'showTransferBill'])->name('show-transfer-bills');
Route::get('/show-dest-stock/{id?}', [TransferController::class, 'showDestStock'])->name('show-dest-stock');
Route::get('/show-stock-items/{id?}', [TransferController::class, 'showStockItems'])->name('show-stock-items');
Route::post('/transfer-store', [TransferController::class, 'store'])->name('transfer-store');
Route::get('/show-transfer-details/{id}', [TransferController::class, 'show'])->name('show-transfer-details');
Route::get('/show-transfer-bill/{id}', [TransferController::class, 'showBill'])->name('show-transfer-bill');
// sales routes
Route::get('/sale', [SaleController::class, 'create'])->name('sale');
Route::get('/sale-list', [SaleController::class, 'index'])->name('sale-list');
Route::get('/show-customer/{id?}', [SaleController::class, 'showCustomer'])->name('show-customer');
Route::get('/filter-items', [SaleController::class, 'filterItems'])->name('filter-items');
Route::get('/show-selected-item/{stock_item_id?}', [SaleController::class, 'showSelectedItem'])->name('show-selected-item');
