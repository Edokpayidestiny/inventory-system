<?php

use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\ProductController;
use App\Http\Controllers\Staff\SalesManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\ProfileController;

Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {
    // User routes
    Route::get('/staff/dashboard', [DashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('staff.products');
    Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('staff.products.show');

    // Sales Management routes
    Route::get('/sales', [SalesManagementController::class, 'index'])->name('staff.sales.index');

    // Profile
    Route::get('profile/index', [ProfileController::class, 'index'])->name('staff.profile');
});
