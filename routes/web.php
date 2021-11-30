<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/checkout', [HomeController::class,'checkout'])->middleware(['auth'])->name('checkout');
Route::get('/add_to_cart/{id}', [HomeController::class,'add_to_cart'])->middleware(['auth'])->name('add_to_cart');
Route::get('/remove_from_cart/{id}', [HomeController::class,'remove_from_cart'])->middleware(['auth'])->name('remove_from_cart');
Route::get('/order/{id}', [HomeController::class,'order'])->middleware(['auth'])->name('order');
Route::get('/history/{id}', [HomeController::class,'history'])->middleware(['auth'])->name('history');
 
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
