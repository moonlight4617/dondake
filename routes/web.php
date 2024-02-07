<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
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

Route::resource('items', ItemController::class)->middleware(['auth', 'verified']);

Route::resource('sales', SaleController::class)->middleware(['auth', 'verified']);

// Route::resource('customers', CustomerController::class)->middleware(['auth', 'verified']);

Route::resource('purchases', PurchaseController::class)->middleware(['auth', 'verified']);

Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);

Route::get('/', [ChartController::class, '__invoke'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
