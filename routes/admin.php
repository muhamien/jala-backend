<?php

use App\Http\Controllers\Admin\DashboardController; 
use Illuminate\Support\Facades\Route;
 
Route::prefix('admin/')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
}); 