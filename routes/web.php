<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::get('/shop', [SiteController::class, 'shop'])->name('shop');

Route::resource('/cart', CartController::class);

Route::get('/dashboard', function () {
    return Inertia::render('DashBoard/Dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PRODUCTS
    Route::resource('/products', ProductsController::class);
    // CATEGORIES
    Route::resource('/categories', CategoriesController::class);
    // ORDERS
    Route::resource('/orders', OrdersController::class);
});

require __DIR__ . '/auth.php';
