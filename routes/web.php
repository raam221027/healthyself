<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\OrderController;




Route::get('/', function () {
    return view('welcome');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth');
});

Route::middleware(['auth', 'check.disabled'])->group(function () {
    // Admin dashboard
    Route::get('admin/dashboard', function () {
        return view('adminDashboard')->with('layouts', 'admin');
    })->name('adminDashboard');

    // Cashier dashboard
    Route::get('cashier/dashboard', function () {
        return view('cashierDashboard')->with('layouts', 'cashier');
    })->name('cashierDashboard');

    // Kitchen dashboard
    Route::get('kitchen/dashboard', function () {
        return view('kitchenDashboard')->with('layouts', 'kitchen');
    })->name('kitchenDashboard');
});

    //Customer Landing Page
    Route::get('landing-page', [CustomerController::class, 'CustomerLandingPage'])->name('customer.landing');

    Route::get('customer/menu', [CustomerController::class, 'showCustomerDashboard'])->name('customer.dashboard');


    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        // Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
    // Enable / Disable Button
        Route::put('/products/{rs}/disable', [ProductController::class, 'disableProduct'])->name('products.disable');
        Route::put('/products/{rs}/enable', [ProductController::class, 'enableProduct'])->name('products.enable');
        Route::post('/toggle-status', 'ProductController@toggleStatus')->name('products.toggleStatus');
    });

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');



// Product Categories Routes
Route::prefix('product/categories')->group(function () {
    Route::get('/', [ProductCategoriesController::class, 'index'])->name('product_categories');
    Route::get('/create', [ProductCategoriesController::class, 'create'])->name('product_categories.create');
    Route::post('/store', [ProductCategoriesController::class, 'store'])->name('product_categories.store');
    // Add more routes for editing, updating, and deleting categories if needed
});



Route::controller(AdminController::class)->prefix('users')->group(function () {
    Route::get('', 'index')->name('users');
    Route::post('create', 'create')->name('admin.create');
    Route::post('store', 'store')->name('admin.store');
    Route::get('show/{id}', 'show')->name('admin.show');
    Route::get('edit/{id}', 'edit')->name('admin.edit');
    Route::put('edit/{id}', 'update')->name('admin.update');
    // Route::delete('destroy/{id}', 'destroy')->name('users.destroy');
    // Enable / Disable Button
        // ... (other routes) ...
        Route::put('/admin/{user}/disable', [AdminController::class, 'disableUser'])->name('admin.disable');
        Route::put('/admin/{user}/enable', [AdminController::class, 'enableUser'])->name('admin.enable');
        Route::post('/toggle-status', 'AdminController@toggleStatus')->name('admin.toggleStatus');
    });
    // Route::post('/products/toggle-status', 'ProductController@toggleStatus')->name('products.toggleStatus');
    
    // Route to show the order form for customers without an account
    Route::get('/order', 'OrderController@showOrderForm')->name('order.customerDashboard');
    // Route::post('/landing-page', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::post('/order', 'OrderController@storeOrder')->name('order.store');
    // Route to process the order submission
    Route::post('/order', [OrderController::class, 'submitOrder'])->name('order.submit');
    // Route to view the order history
    Route::get('/order/history', [OrderController::class, 'viewOrderHistory'])->name('order.history');
    
    Route::get('/customer/dashboard/{id}', [CustomerController::class, 'showCustomerDashboard']);
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/receipt', 'CustomerController@showOrderReceipt')->name('order.receipt');


    

    

    
    
