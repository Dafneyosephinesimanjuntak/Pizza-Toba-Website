<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Web\ProfileController;

Route::group(['domain' => ''], function () {
    Route::get('admin/auth', [AuthController::class, 'index'])->name('auth.index');
    Route::prefix('admin/')->name('admin.')->group(function () {
        Route::prefix('auth')->name('auth.')->group(function () {
            Route::post('login', [AuthController::class, 'do_login'])->name('login');
        });
        Route::middleware('can:Admin')->group(function () {
            Route::redirect('/', 'dashboard', 301);
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('menu', MenuController::class);
            Route::get('order', [OrderController::class, 'index'])->name('order.index');
            Route::get('order/pdf', [OrderController::class, 'pdf'])->name('order.pdf');
            Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
            Route::patch('order/accept/{order}', [OrderController::class, 'accept'])->name('order.accept');
            Route::patch('order/reject/{order}', [OrderController::class, 'reject'])->name('order.reject');
            Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');            
            
            // COUPON
            Route::resource('coupon', CouponController::class);
            // Notification
            Route::get('counter', [NotificationController::class, 'counter'])->name('counter_notif');
            Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
        });
    });
});
