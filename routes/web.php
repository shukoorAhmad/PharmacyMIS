<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
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

// supplier crud
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
Route::post('/supplierstore', [SupplierController::class, 'store'])->name('supplierstore');

// items crud
Route::get('/item', [ItemController::class, 'index'])->name('item');
Route::post('/itemstore', [ItemController::class, 'store'])->name('itemstore');

// Customer Routes
Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
Route::post('/customerstore', [CustomerController::class, 'store'])->name('customerstore');

// Stock Routes
Route::get('/stock', [StockController::class, 'index'])->name('stock');
Route::post('/stockstore', [StockController::class, 'store'])->name('stockstore');

// Order Routes
Route::get('/order-list', [OrderController::class, 'index'])->name('order-list');
Route::get('/order', [OrderController::class, 'create'])->name('order');
Route::post('/orderItemStore', [OrderController::class, 'store'])->name('orderItemStore');
Route::get('/addNewItem', [OrderController::class, 'addNewItem'])->name('addNewItem');
Route::get('/view-order-details/{id}', [OrderController::class, 'view'])->name('view-order-details');
Route::get('/edit-order-details/{id}', [OrderController::class, 'edit'])->name('edit-order-details');
Route::post('/update-order-details', [OrderController::class, 'update'])->name('update-order-details');
Route::get('/delete-order-item/{id}', [OrderController::class, 'deleteOrderItem'])->name('delete-order-item');
// purchase routes
Route::get('/purchase-order/{id}', [PurchaseController::class, 'purchaseItems'])->name('purchase-order');
Route::post('/store-purchase', [PurchaseController::class, 'store'])->name('store-purchase');
Route::get('/purchase-list', [PurchaseController::class, 'index'])->name('purchase-list');
Route::get('/purchase', [PurchaseController::class, 'create'])->name('purchase');
Route::get('/filter-item', [PurchaseController::class, 'filter_items'])->name('filter-item');
Route::get('/add_new_item/{item_id?}/{i?}', [PurchaseController::class, 'add_new_item'])->name('add_new_item');
Route::get('/view-purchase-details/{id}', [PurchaseController::class, 'show'])->name('view-purchase-details');
Route::get('/return-purchase/{id?}', [PurchaseController::class, 'reutrnPurchase'])->name('return-purchase');
// Seller Routes
Route::get('/seller', [SellerController::class, 'index'])->name('seller');
Route::post('/sellerstore', [SellerController::class, 'store'])->name('sellerstore');

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
Route::get('/show-selected-item/{stock_item_id?}/{i?}', [SaleController::class, 'showSelectedItem'])->name('show-selected-item');
Route::post('/sale-store', [SaleController::class, 'store'])->name('sale-store');
Route::get('/show-sale-bill/{id}', [SaleController::class, 'show'])->name('show-sale-bill');
Route::get('/return-sale/{id?}', [SaleController::class, 'returnSale'])->name('return-sale');

// expense routes
Route::get('/expense', [ExpenseController::class, 'create'])->name('expense');
Route::get('/expense-list', [ExpenseController::class, 'index'])->name('expense-list');
Route::post('/expense-store', [ExpenseController::class, 'store'])->name('expense-store');
Route::get('/expense-edit', [ExpenseController::class, 'edit'])->name('expense-edit');
Route::post('/expense-update', [ExpenseController::class, 'update'])->name('expense-update');
