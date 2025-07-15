<?php

use App\Http\Controllers\BillingContoller;
use App\Http\Controllers\CategoriesContoller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductContoller;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::get('/login', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('Login');
})->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/login', [LoginController::class, 'login'])->name('login.form');
Route::get('/sign-up', function() {
    return redirect()->route('login')->withErrors(['signup_error' => 'Signup is disabled. This is a single-user system.']);
})->name('signup.form.page');
Route::post('/sign-up', [LoginController::class, 'signup'])->name('signup.form')->middleware('single.user');
Route::get('/edit-profile', [LoginController::class, 'editProfile'])->name('edit.profile');
Route::post('/update-profile', [LoginController::class, 'updateProfile'])->name('update.profile');
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    // Billing
    Route::get('/reshma-billing', [BillingContoller::class, 'BillingMethod'])->name('billings.page');

    // Categories
    Route::post('/add-category', [CategoriesContoller::class, 'addCategory'])->name('add.category');
    Route::get('/all-categories', [CategoriesContoller::class, 'allCategories'])->name('all.categories');
    Route::get('/destroy-category/{id}', [CategoriesContoller::class, 'DestroyCategories'])->name('destroy.category');

    // Products
    Route::post('/add-product', [ProductContoller::class, 'addProduct'])->name('add.product');
    Route::get('/all-products', [ProductContoller::class, 'allProducts'])->name('all.products');
    
    // Orders
    Route::post('/store-order', [OrderController::class, 'store'])->name('store.order');
    Route::get('/next-order-number', [OrderController::class, 'getNextOrderNumber']);
    Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');
    Route::get('/api/order-history', [OrderController::class, 'getOrderHistory'])->name('order.history.api');
    Route::get('/order/{id}', [OrderController::class, 'getOrderDetails'])->name('order.details');
    Route::put('/order/{id}/status', [OrderController::class, 'updateOrderStatus'])->name('order.update.status');
    Route::delete('/order/{id}', [OrderController::class, 'deleteOrder'])->name('order.delete');
    Route::get('/order-stats', [OrderController::class, 'getOrderStats'])->name('order.stats');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/api/settings/update', [SettingsController::class, 'updateGeneralSettings'])->name('settings.update');
    Route::get('/api/settings', [SettingsController::class, 'getSettings'])->name('settings.get');
    Route::delete('/api/settings/delete-logo', [SettingsController::class, 'deleteLogo'])->name('settings.delete-logo');
});

