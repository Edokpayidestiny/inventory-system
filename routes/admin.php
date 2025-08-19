<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\AdjustmentHistoryController;
use App\Http\Controllers\Admin\SalesManagementController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Admin routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::patch('/products/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');


    // Category routes

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/categories/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Route::get('profile/index', [ProfileController::class, 'create'])->name('admin.profile');

    // Inventory routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('admin.inventory');
    Route::get('/inventory/show/{product}', [InventoryController::class, 'show'])->name('admin.inventory.show');
    Route::get('/inventory/edit/{product}', [InventoryController::class, 'edit'])->name('admin.inventory.edit');
    Route::patch('/inventory/update/{product}', [InventoryController::class, 'update'])->name('admin.inventory.update');
    Route::get('/inventory/history', [AdjustmentHistoryController::class, 'index'])->name('admin.inventory.history');

    // Sales Management routes
    Route::get('/sales', [SalesManagementController::class, 'index'])->name('admin.sales.index');
    Route::get('/sales/history', [SalesManagementController::class, 'history'])->name('admin.sales.history');
    Route::get('/sales/show/{sale}', [SalesManagementController::class, 'show'])->name('admin.sales.show');
    Route::get('/sales/print', [SalesManagementController::class, 'printAll'])->name('admin.sales.print.all');
    Route::get('/sales/print/{sale}', [SalesManagementController::class, 'print'])->name('admin.sales.print');
    Route::get('/sales/pdf/{sale}', [SalesManagementController::class, 'pdf'])->name('admin.sales.pdf');
    Route::get('/sales/filter', [SalesManagementController::class, 'filter'])->name('admin.sales.filter');
});
