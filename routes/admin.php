<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
 
Route::prefix('admin/')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category', ProductCategoryController::class);
}); 