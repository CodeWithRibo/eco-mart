<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

/*Routing for User*/
Route::middleware(['auth', 'verified', 'is_user'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
});

/*Routing for Admin*/
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return 'admin dashboard';
    });
});

Route::get('logout', function(Request $request) {
    auth()->guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
});

require __DIR__.'/auth.php';
