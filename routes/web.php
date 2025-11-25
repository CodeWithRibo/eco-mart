<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Rider\RiderDashboardController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderHistoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ShoppingCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

/*Routing for User*/
Route::middleware(['auth', 'verified', 'is_customer'])->group(function () {
    Route::view('dashboard', 'user.dashboard')->name('dashboard');
    Route::view('profile', 'user.profile')->name('profile');
    Route::get('products', ProductController::class)->name('products');
    Route::get('shopping-carts', ShoppingCartController::class)->name('shopping-carts');
    Route::get('shopping-carts/checkout', CheckoutController::class)->name('shopping-carts.checkout');
    Route::get('order-history', OrderHistoryController::class)->name('order-history');
});

/*Routing for Admin*/
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');
    Route::get('admin/inventories', InventoryController::class)->name('admin.inventories');
    Route::get('admin/orders', OrderController::class)->name('admin.orders');
    Route::get('admin/customers', CustomerController::class)->name('admin.customer');
});

/*Routing for riders*/
Route::middleware(['auth', 'is_rider'])->group(function () {
    Route::get('rider/dashboard', RiderDashboardController::class) ->name('rider.dashboard');
});
Route::delete('logout',LogoutController::class)->name('logout-account');
Route::get('logout', function(Request $request) {
    auth()->guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
});

require __DIR__.'/auth.php';
