<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
 
Route::prefix('admin/')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category', ProductCategoryController::class);
    Route::resource('order', OrderController::class);
    Route::get('order/{order}/detail', [OrderController::class,'detail'])->name('order.detail');
    Route::get('order/{order}/process', [OrderController::class,'process_order'])->name('order.process');
    Route::get('order/{order}/complete', [OrderController::class,'complete_order'])->name('order.complete');
    Route::post('order/{order}/detail/add', [OrderController::class,'add_item'])->name('order.detail.add');
    Route::post('order/{order}/detail/{id}/remove', [OrderController::class,'remove_item'])->name('order.detail.remove');
}); 